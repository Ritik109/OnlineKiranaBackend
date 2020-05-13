<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
    protected $table = 'category';
}
