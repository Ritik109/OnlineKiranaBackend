<?php

namespace App\Http\Controllers\Api;

use Response; 
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\AppUser;
use App\Order;
use App\Order_item;
use App\AppCarousel;
use App\Http\Controllers\Controller;

class AppHomePageController extends Controller
{
    public function index($userId)
    {
        try{
            //fetching all available categories
        $categories=Category::all();
        foreach($categories as $category)
        {
            $category['cate_icon_url']=url('/')."/category_images/".$category['cate_icon_url'];

        }
        //fetching top products
        $topProducts=Product::orderByRaw('popularity DESC')->get()->take(10);
        foreach($topProducts as $topProduct)
        {
            $topProduct['image_url']=url('/')."/product_images/".$topProduct['image_url'];

        }
        //fetching recommanded products

        $recomanded=Product::where(['recomanded'=>'yes'])->get();
        foreach($recomanded as $recom)
        {
            $recom['image_url']=url('/')."/product_images/".$recom['image_url'];

        }
        $count = AppUser::where('user_id', $userId)->count();
        if($count>0){
            $order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->get('order_id');
            if($order->isEmpty()){
                $cart_items=[];
                }else{
                        $cart_items=Order_item::where('order_id',$order->first()->order_id)->get(['product_id','quantity']);
                        //return $cart_items;

                    }
                        
                            
                        }
        $app_carousel=AppCarousel::where('status','active')->get('carousel_img_url');
        foreach($app_carousel as $app_caro)
        {
            $app_caro['carousel_img_url']=url('/')."/carousel_images/".$app_caro['carousel_img_url'];

        }
        
        return Response::json(
            array(
                'categories' =>  $categories,
                'top-products' => $topProducts,
                'recomanded'=>$recomanded,
                'cart-items'=>$cart_items,
                'app-carousel'=>$app_carousel,
                'message'   =>  "Data Fetched"
            ), 200);

        } catch(Exception $e){
            return Response::json(
                array(
                    'Success' =>  false ,
                    'message'   =>  "Data Fetched not Fetched"
                ), 500);
        }
        
    }

    
}
