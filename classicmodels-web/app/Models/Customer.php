<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'customerNumber';
    protected $fillable = ['customerNumber','customerName','contactLastName','contactFirstName','phone','addressLine1','addressLine2','city','state','postalCode','country','salesRepEmployeeNumber','creditLimit'];

    public function salesRep()
    {
        return $this->belongsTo(Employee::class, 'salesRepEmployeeNumber', 'employeeNumber');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customerNumber', 'customerNumber');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'customerNumber', 'customerNumber');
    }
}
