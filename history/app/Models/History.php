<?php

namespace App\Models;

use App\Models\History;

use Illuminate\Database\Eloquent\Model;


class History extends Model {

    public $timestamps = false;

    protected $table = 'historytbl';

    protected $fillable = [
        'ask', 'response', 'user_id'
    ];

    protected $hidden = ['user_id', 'id'];

}