<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\bill;


class order extends Model
{
    use HasFactory;
    protected $table = 'pizza';

    protected $fillable = [
        'name',
        'qty',
        'price',
        'user_id',
        'bill_id',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bill()
    {
        return $this->belongsTo(bill::class);
    }
}
