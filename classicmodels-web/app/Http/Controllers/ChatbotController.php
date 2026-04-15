<?php

namespace App\Http\Controllers;

use App\Models\{Customer, Product, Order, Productline};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function ask(Request $request)
    {
        $message = trim($request->input('message', ''));
        if ($message === '') {
            return response()->json(['reply' => 'Please enter a message.']);
        }

        $apiKey = config('services.openai.key');

        if ($apiKey) {
            $reply = $this->askOpenAI($message, $apiKey);
        } else {
            $reply = $this->processMessage(strtolower($message));
        }

        return response()->json(['reply' => $reply]);
    }

    // ── OpenAI Chat Completions ─────────────────────────────────────────────

    private function askOpenAI(string $message, string $apiKey): string
    {
        $context = $this->buildDbContext();
        $model   = config('services.openai.model', 'gpt-4o-mini');

        $response = Http::withToken($apiKey)
            ->timeout(20)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model'       => $model,
                'temperature' => 0.4,
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => <<<SYS
You are a helpful assistant for ClassicModels — a company that sells classic scale model cars, motorcycles, planes, ships, trains, and trucks.
Answer questions about our business data. Be concise and friendly.
Use **bold** for key numbers and names.

Current database snapshot:
{$context}
SYS,
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

        if ($response->failed()) {
            return 'OpenAI API error: ' . $response->status() . '. Please try again later.';
        }

        return $response->json('choices.0.message.content', 'No response received.');
    }

    private function buildDbContext(): string
    {
        $totalCustomers = Customer::count();
        $totalProducts  = Product::count();
        $totalOrders    = Order::count();
        $totalRevenue   = number_format(DB::table('payments')->sum('amount'), 2);
        $pendingOrders  = Order::where('status', 'In Process')->count();
        $productLines   = Productline::pluck('productLine')->join(', ');

        $topCustomer = DB::table('payments')
            ->join('customers', 'payments.customerNumber', '=', 'customers.customerNumber')
            ->select('customers.customerName', DB::raw('SUM(amount) as total'))
            ->groupBy('customers.customerName')
            ->orderByDesc('total')
            ->first();

        $topProduct = DB::table('orderdetails')
            ->join('products', 'orderdetails.productCode', '=', 'products.productCode')
            ->select('products.productName', DB::raw('SUM(quantityOrdered) as qty'))
            ->groupBy('products.productName')
            ->orderByDesc('qty')
            ->first();

        $lines = [];
        foreach (Productline::withCount('products')->get() as $pl) {
            $lines[] = "{$pl->productLine} ({$pl->products_count} items)";
        }

        return implode("\n", [
            "- Total customers: {$totalCustomers}",
            "- Total products: {$totalProducts} across product lines: " . implode(', ', $lines),
            "- Total orders: {$totalOrders} (pending/in-process: {$pendingOrders})",
            "- Total revenue (payments): \${$totalRevenue}",
            "- Top customer by payments: " . ($topCustomer ? "{$topCustomer->customerName} (\${$topCustomer->total})" : 'N/A'),
            "- Best-selling product: " . ($topProduct ? "{$topProduct->productName} ({$topProduct->qty} units)" : 'N/A'),
        ]);
    }

    // ── Rule-based fallback (no API key) ───────────────────────────────────

    private function processMessage(string $msg): string
    {
        if (str_contains($msg, 'how many customer') || str_contains($msg, 'total customer')) {
            return 'There are currently **' . Customer::count() . ' customers** in the system.';
        }
        if (str_contains($msg, 'how many product') || str_contains($msg, 'total product')) {
            return 'There are **' . Product::count() . ' products** available.';
        }
        if (str_contains($msg, 'best sell') || str_contains($msg, 'top product')) {
            $p = DB::table('orderdetails')
                ->join('products', 'orderdetails.productCode', '=', 'products.productCode')
                ->select('products.productName', DB::raw('SUM(quantityOrdered) as qty'))
                ->groupBy('products.productName')->orderByDesc('qty')->first();
            return $p ? "The best-selling product is **{$p->productName}** with {$p->qty} units sold." : 'No data.';
        }
        if (str_contains($msg, 'product line') || str_contains($msg, 'category')) {
            return 'We have: **' . Productline::pluck('productLine')->join(', ') . '**.';
        }
        if (str_contains($msg, 'how many order') || str_contains($msg, 'total order')) {
            return 'There are **' . Order::count() . ' orders** in the system.';
        }
        if (str_contains($msg, 'top customer') || str_contains($msg, 'best customer')) {
            $c = DB::table('payments')
                ->join('customers', 'payments.customerNumber', '=', 'customers.customerNumber')
                ->select('customers.customerName', DB::raw('SUM(amount) as total'))
                ->groupBy('customers.customerName')->orderByDesc('total')->first();
            return $c ? "The top customer is **{$c->customerName}** with \$" . number_format($c->total, 2) . '.' : 'No data.';
        }
        if (str_contains($msg, 'revenue') || str_contains($msg, 'total sales')) {
            return 'Total recorded revenue is **$' . number_format(DB::table('payments')->sum('amount'), 2) . '**.';
        }
        if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'xin chao')) {
            return "Hello! I'm the ClassicModels assistant. Ask me about customers, products, orders, or revenue!";
        }
        if (str_contains($msg, 'help') || str_contains($msg, 'what can')) {
            return "I can answer:\n- How many customers / products / orders?\n- What are the product lines?\n- Who is the best customer?\n- What is the best-selling product?\n- What is the total revenue?";
        }
        return "Sorry, I didn't understand that. Type **help** for examples.";
    }
}

    public function index()
    {
        return view('chatbot.index');
    }

    public function ask(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));
        $reply = $this->processMessage($message);
        return response()->json(['reply' => $reply]);
    }

    private function processMessage(string $msg): string
    {
        // How many customers
        if (str_contains($msg, 'how many customer') || str_contains($msg, 'total customer')) {
            $count = Customer::count();
            return "There are currently **{$count} customers** in the system.";
        }

        // How many products
        if (str_contains($msg, 'how many product') || str_contains($msg, 'total product')) {
            $count = Product::count();
            return "There are **{$count} products** available.";
        }

        // Best selling product
        if (str_contains($msg, 'best sell') || str_contains($msg, 'top product')) {
            $product = DB::table('orderdetails')
                ->join('products', 'orderdetails.productCode', '=', 'products.productCode')
                ->select('products.productName', DB::raw('SUM(quantityOrdered) as qty'))
                ->groupBy('products.productName')
                ->orderByDesc('qty')
                ->first();
            if ($product) {
                return "The best-selling product is **{$product->productName}** with {$product->qty} units sold.";
            }
        }

        // Product lines
        if (str_contains($msg, 'product line') || str_contains($msg, 'category')) {
            $lines = Productline::pluck('productLine')->join(', ');
            return "We have the following product lines: **{$lines}**.";
        }

        // Order count
        if (str_contains($msg, 'how many order') || str_contains($msg, 'total order')) {
            $count = Order::count();
            return "There are **{$count} orders** in the system.";
        }

        // Top customer
        if (str_contains($msg, 'top customer') || str_contains($msg, 'best customer')) {
            $customer = DB::table('payments')
                ->join('customers', 'payments.customerNumber', '=', 'customers.customerNumber')
                ->select('customers.customerName', DB::raw('SUM(amount) as total'))
                ->groupBy('customers.customerName')
                ->orderByDesc('total')
                ->first();
            if ($customer) {
                $total = number_format($customer->total, 2);
                return "The top customer is **{$customer->customerName}** with total payments of \${$total}.";
            }
        }

        // Revenue
        if (str_contains($msg, 'revenue') || str_contains($msg, 'total sales')) {
            $revenue = DB::table('payments')->sum('amount');
            $formatted = number_format($revenue, 2);
            return "Total recorded revenue is **\${$formatted}**.";
        }

        // Greetings
        if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'xin chao')) {
            return "Hello! I'm the ClassicModels assistant. You can ask me about customers, products, orders, revenue, and more!";
        }

        // Help
        if (str_contains($msg, 'help') || str_contains($msg, 'what can')) {
            return "I can answer questions like:\n- How many customers do we have?\n- What are the product lines?\n- Who is the best customer?\n- What is the best-selling product?\n- What is the total revenue?";
        }

        return "Sorry, I didn't understand that. Try asking about customers, products, orders, or revenue. Type **help** for examples.";
    }
}
