<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\order;

class bill extends Model
{
    use HasFactory;

    protected $table = 'bill';

    protected $fillable = [
        'user_id', 
        'is_active', 
        'status',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
