<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    
    protected $fillable = ['bank_id', 'currency_id', 'buying_rate', 'selling_rate', 'rate_date'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function rateHistory()
    {
        return $this->hasMany(RateHistory::class);
    }
}
