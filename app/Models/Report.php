<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'areaOfConcern',
        'status',
        'actionTaken',
        'remarks',
        'user_id',
    ];


    //Table Name
    protected $table = 'reports';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true;

    public  function user(){
        return $this->belongsTo('App\Models\User');
    }
}
