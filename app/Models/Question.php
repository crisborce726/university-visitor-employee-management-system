<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'user_id',
    ];

    //Table Name
    protected $table = 'questions';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true;

    public  function user(){
        return $this->belongsTo('App\Models\User');
    }
}
