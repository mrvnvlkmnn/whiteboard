<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
    protected $fillable = [
        'survey_number',
        'programmer',
        'project_manager',
        'detail',
        'feldstart',
        'status'
    ];
    protected $casts = [
        'programmer' => 'array',
        'project_manager' => 'array'
    ];

    use SoftDeletes;

}
