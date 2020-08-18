<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examuser extends Model
{
    protected $table = 'examusers';
    protected $fillable = [
        'Account', 'Password',
    ];
}
