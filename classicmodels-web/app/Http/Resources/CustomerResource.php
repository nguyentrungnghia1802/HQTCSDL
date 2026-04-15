<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'customerNumber'   => $this->customerNumber,
            'customerName'     => $this->customerName,
            'contact'          => $this->contactFirstName . ' ' . $this->contactLastName,
            'phone'            => $this->phone,
            'city'             => $this->city,
            'country'          => $this->country,
            'creditLimit'      => $this->creditLimit,
            'orders_count'     => $this->whenLoaded('orders', fn() => $this->orders->count()),
            'total_payments'   => $this->whenLoaded('payments', fn() => $this->payments->sum('amount')),
        ];
    }
}
