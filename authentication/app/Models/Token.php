<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;


class Token extends Model {


    

    public $timestamps = false;

    protected $table = 'users';

    protected $fillable = [
        'id', 'tokens'
    ];

    protected $hidden =[
        "password"
    ];
}