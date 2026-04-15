<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'orderNumber';
    protected $fillable = ['orderNumber','orderDate','requiredDate','shippedDate','status','comments','customerNumber'];
    protected $casts = ['orderDate'=>'date','requiredDate'=>'date','shippedDate'=>'date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerNumber', 'customerNumber');
    }

    public function orderDetails()
    {
        return $this->hasMany(Orderdetail::class, 'orderNumber', 'orderNumber');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderdetails', 'orderNumber', 'productCode')
                    ->withPivot('quantityOrdered','priceEach','orderLineNumber');
    }
}
