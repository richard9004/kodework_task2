<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ['name', 'price', 'gst', 'gst_type', 'created_at', 'updated_at','quantity'];
    
}
