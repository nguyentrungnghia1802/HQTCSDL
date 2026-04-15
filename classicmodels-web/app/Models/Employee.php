<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'employeeNumber';
    protected $fillable = ['employeeNumber','lastName','firstName','extension','email','officeCode','reportsTo','jobTitle'];

    public function office()
    {
        return $this->belongsTo(Office::class, 'officeCode', 'officeCode');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'reportsTo', 'employeeNumber');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'reportsTo', 'employeeNumber');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'salesRepEmployeeNumber', 'employeeNumber');
    }
}
