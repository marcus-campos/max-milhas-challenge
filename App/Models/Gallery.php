<?php

namespace App\Models;


use Milhas\Model\BaseModel;

class Gallery extends BaseModel
{
    protected $table = 'gallery';

    protected $fillable = [
        'name',
        'path',
        'created_at'
    ];
}