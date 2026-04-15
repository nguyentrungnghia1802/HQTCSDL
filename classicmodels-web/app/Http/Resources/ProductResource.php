<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'productCode'     => $this->productCode,
            'productName'     => $this->productName,
            'productLine'     => $this->productLine,
            'productScale'    => $this->productScale,
            'productVendor'   => $this->productVendor,
            'quantityInStock' => $this->quantityInStock,
            'buyPrice'        => $this->buyPrice,
            'MSRP'            => $this->MSRP,
            'description'     => $this->productDescription,
        ];
    }
}
