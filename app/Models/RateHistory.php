<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateHistory extends Model
{
    use HasFactory;
    
    protected $table="rate_history";

    protected $fillable = ['exchange_rate_id', 'old_buying_rate', 'old_selling_rate', 'new_buying_rate', 'new_selling_rate', 'changed_at'];

    public function exchangeRate()
    {
        return $this->belongsTo(ExchangeRate::class);
    }
}
