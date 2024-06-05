<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_test extends Model
{
    use HasFactory;

    protected $table = 'user_test';
    protected $fillable=[
        'name',
        'age',
    ];
}
