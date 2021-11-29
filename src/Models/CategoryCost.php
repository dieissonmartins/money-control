<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCost extends Model
{
    protected $table = "category_costs";

    protected $fillable = [
        'id',
        'name',
        'user_id'
    ];
}