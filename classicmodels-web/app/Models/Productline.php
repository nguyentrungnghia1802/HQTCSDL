<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productline extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'productLine';
    protected $keyType = 'string';
    protected $fillable = ['productLine','textDescription','htmlDescription'];

    public function products()
    {
        return $this->hasMany(Product::class, 'productLine', 'productLine');
    }
}
