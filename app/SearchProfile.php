<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchProfile extends Model
{
    protected $fillable = ['name','propertyType','searchFields'];
}
