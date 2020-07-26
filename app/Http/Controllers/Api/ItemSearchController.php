<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use Response;
use App\Http\Controllers\Controller;

class ItemSearchController extends Controller
{
    //

    public function search_item($search_item)
    {
        try{
            $searched_items = Product::where('name_in_eng','LIKE',"%{$search_item}%")->get();
                //return $$searched_item->name_in_eng;
                if($searched_items==null){
                    return Response::json(
                        array(
                            'Success' =>  true,
                            'data' => [],
                            'message'   =>  "didn't get any relevant item"
                        ), 200);
                        }
                        foreach($searched_items as $searched_item)
                        {
                            $searched_item['image_url']=url('/')."/product_images/".$searched_item['image_url'];
                        }                 
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => $searched_items,
                        'message'   =>  "item searched succesfully"
                    ), 200);
        }
        catch(Exception $e)
        {
            return Response::json(
                array(
                    'Success' =>  false,
                    'data' => [],
                    'message'   =>  $e
                ), 400);
        }
    }
}
