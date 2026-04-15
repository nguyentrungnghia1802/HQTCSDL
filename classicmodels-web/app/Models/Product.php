<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'productCode';
    protected $keyType = 'string';
    protected $fillable = ['productCode','productName','productLine','productScale','productVendor','productDescription','quantityInStock','buyPrice','MSRP'];

    public function productline()
    {
        return $this->belongsTo(Productline::class, 'productLine', 'productLine');
    }

    public function orderDetails()
    {
        return $this->hasMany(Orderdetail::class, 'productCode', 'productCode');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderdetails', 'productCode', 'orderNumber')
                    ->withPivot('quantityOrdered','priceEach','orderLineNumber');
    }
}
