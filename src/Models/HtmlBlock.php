<?php

namespace ClaudiusNascimento\HtmlBlocks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HtmlBlock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key',
        'rel',
        'rel_id',
        'title',
        'sub_title',
        'content',
        'active',
        'order',
        'image',
        'layout'
    ];
}

