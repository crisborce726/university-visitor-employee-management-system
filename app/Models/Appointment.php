<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'departmentOffice',
        'date',
        'time',
        'purpose',
        'visitant',
        'status',
        'reson',
        'user_id',
    ];

    //Table Name
    protected $table = 'appointments';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true;

    public  function user(){
        return $this->belongsTo('App\Models\User');
    }
}
