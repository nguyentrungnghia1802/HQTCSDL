<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['customerNumber','checkNumber','paymentDate','amount'];
    protected $casts = ['paymentDate'=>'date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerNumber', 'customerNumber');
    }
}
