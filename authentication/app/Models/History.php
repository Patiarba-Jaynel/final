<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;


class History extends Model {

    public $timestamps = false;

    protected $table = 'historytbl';

    protected $fillable = [
        'ask', 'response', 'user_id'
    ];

}