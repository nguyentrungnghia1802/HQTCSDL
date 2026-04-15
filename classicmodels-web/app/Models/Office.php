<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'officeCode';
    protected $keyType = 'string';
    protected $fillable = ['officeCode','city','phone','addressLine1','addressLine2','state','country','postalCode','territory'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'officeCode', 'officeCode');
    }
}
