<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeIn',
        'entrance',
        'dateIn',
        'timeOut',
        'ext',
        'user_id',
        'visit_department',
    ];
}
