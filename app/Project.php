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
        'fieldstart',
        'status',
        'update_list',
        'mail_sent_at',
    ];
    protected $casts = [
        'programmer' => 'array',
        'project_manager' => 'array',
        'fieldstart' => 'date',
        'update_list' => 'array',
    ];
    /**
     * @var mixed
     */

    use SoftDeletes;

}
