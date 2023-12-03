<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actionlog extends Model
{
    protected $fillable=[
        'actionlog_id',
        'user_id',
        'post_id'
    ];
    use HasFactory;
}
