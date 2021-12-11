<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillPay extends Model
{
    //Mass Assignment
    protected $fillable = [
        'date_launch',
        'name',
        'value',
        'user_id',
        'category_cost_id'
    ];

    /**
     * @return BelongsTo
     */
    public function categoryCost(): BelongsTo
    {
        return $this->belongsTo(CategoryCost::class);
    }
}