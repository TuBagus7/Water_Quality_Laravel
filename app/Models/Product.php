<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // model ini secara default sudah mewakili table products
    protected $table = "products";

    protected $fillable = ["name", "description", "stock", "price", "status"];
}
