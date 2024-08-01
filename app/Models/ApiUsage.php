<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUsage extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'endpoint', 'request_count', 'last_request_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
