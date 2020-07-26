<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function get_category($category_id)
    {
        try{
            $items = Product::where('category_id',$category_id)->get();
                //return $$searched_item->name_in_eng;
                if($items==null){
                    return Response::json(
                        array(
                            'Success' =>  true,
                            'data' => [],
                            'message'   =>  "didn't get any relevant item"
                        ), 200);
                        } 
                        foreach($items as $item)
                        {
                        $item['category_id']=Category::where('cate_id',$category_id)->first()->name_in_eng;
                        $item['image_url']=url('/')."/product_images/".$item['image_url'];

                        }               
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => $items,
                        'message'   =>  "Fetched All Items of specified Category"
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
