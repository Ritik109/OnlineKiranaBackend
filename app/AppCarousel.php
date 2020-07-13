<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppCarousel extends Model
{
    //
    protected $table = 'app_carousel';
    protected $primaryKey = 'carousel_id';
    protected $guarded = [];
}
