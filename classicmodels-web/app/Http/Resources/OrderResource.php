<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'orderNumber'   => $this->orderNumber,
            'orderDate'     => $this->orderDate,
            'requiredDate'  => $this->requiredDate,
            'shippedDate'   => $this->shippedDate,
            'status'        => $this->status,
            'comments'      => $this->comments,
            'customerNumber'=> $this->customerNumber,
            'customer'      => $this->whenLoaded('customer', fn() => $this->customer->customerName),
            'total'         => $this->whenLoaded('orderDetails', fn() =>
                $this->orderDetails->sum(fn($d) => $d->quantityOrdered * $d->priceEach)
            ),
        ];
    }
}
