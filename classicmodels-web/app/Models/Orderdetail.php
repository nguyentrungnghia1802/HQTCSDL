<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    public $timestamps = false;
    protected $table = 'orderdetails';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['orderNumber','productCode','quantityOrdered','priceEach','orderLineNumber'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderNumber', 'orderNumber');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productCode', 'productCode');
    }
}
