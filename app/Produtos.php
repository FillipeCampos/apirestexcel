<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    //
    protected $fillable = [
      'code', 'name', 'free_shipping','description', 'price'
    ]
}
