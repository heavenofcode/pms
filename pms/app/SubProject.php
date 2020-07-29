<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    protected $fillable = [
        'prjid', 'sbprjnm', 'sbprdesc', 'sbprddline'
    ];
}
