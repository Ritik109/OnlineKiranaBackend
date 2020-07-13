<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    //
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    protected $guarded = [];
}
