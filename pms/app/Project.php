<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'empid', 'prjnm', 'prjdesc', 'prjddline'
    ];
}
