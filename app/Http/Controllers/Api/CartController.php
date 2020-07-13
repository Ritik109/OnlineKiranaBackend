<?php
namespace App\Http\Controllers\Api;
use App\AppUser;
        use App\Order;
        use App\Order_item;
        use App\Product;
        use App\Address;
        use Illuminate\Http\Request;
        use Response;
        use App\Http\Controllers\Controller;

        class CartController extends Controller
        {

            
                public function add_to_cart($userId,$productId,$addOrRemove)
                {
                    
                    try
                    {

                    $count = AppUser::where('user_id', $userId)->count();
                    if($count==0){
                        return Response::json(
                            array(
                                'Success' =>  false,
                                'message'   =>  "User Not Found"
                            ), 404);
                    }
                        $order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->get('order_id');
                        if($order->isEmpty()){
                            $order=new Order(['order_id'=>null,'user_id'=>$userId,'order_status'=>'cart']);
                            $order->save();
                            $order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->get('order_id');
                            
                        }
                        

                        $cart_item=Order_Item::where(['order_id'=>$order->first()->order_id,'product_id'=>$productId])->count();
                        if($cart_item==0 && $addOrRemove=='incr')
                        {
                            $cart_item=new Order_Item(['order_item_id'=>null,'order_id'=>$order->first()->order_id,'product_id'=>$productId,'quantity'=>1]);
                            $cart_item->save();
                        }else if($cart_item!=0 && $addOrRemove=='incr'){
                            $cart_item=Order_Item::where(['order_id'=>$order->first()->order_id,'product_id'=>$productId])->increment('quantity');
                        
                        }
                        else if($cart_item!=0 && $addOrRemove=='decr'){
                            $cart_item=Order_Item::where(['order_id'=>$order->first()->order_id,'product_id'=>$productId])->decrement('quantity');
                        
                        }
                        else if($cart_item!=0 && $addOrRemove=='remove'){
                            $cart_item=Order_Item::where(['order_id'=>$order->first()->order_id,'product_id'=>$productId])->delete();
                        
                        }
                        else{
                            return Response::json(
                                array(
                                    'Success' =>  false,
                                    'message'   =>  "Bad Request",
                                ), 405);
                        }
                        return Response::json(
                            array(
                                'Success' =>  true,
                                'message'   =>  "Cart Updated Successfully",
                            ), 200);
                        
                }catch(Exception $e){
                    return Response::json(
                        array(
                            'Success' =>  false,
                            'message'   =>  "Something Went Wrong!"
                        ), 500);
                }
                }

            public function cart_items($userId)
            {
                //
                try{
                $count = AppUser::where('user_id', $userId)->count();
                    if($count==0){
                        return Response::json(
                            array(
                                'Success' =>  false,
                                'message'   =>  "User Not Found"
                            ), 404);
                    }
                    $order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->get('order_id');
                    if($order->isEmpty()){
                        return Response::json(
                            array(
                                'Success' =>  true,
                                'data'=>[], 
                                'message'   =>  "No Item in Cart"
                            ), 200);
                    }
                    $cart_items=Order_Item::where(['order_id'=>$order->first()->order_id])->pluck('product_id');
                    if($cart_items->isEmpty()){
                        $data=[];
                    }
                    else{
                        //return $cart_items;
                        $results=Product::find($cart_items);
                        $sub_total=0;
                        $discount=0;
                        foreach($results as $result)
                        {
                            $result['image_url']=url('/')."/product_images/".$result['image_url'];
                            $sub_total+=$result['price'];
                        }
                        return Response::json(
                            array(
                                'Success' =>  true,
                                'items'=>$results,
                                'sub_total'=>$sub_total,
                                'discount'=>$discount,
                                'total'=>$sub_total-$discount,
                                'message'   =>  "Items in Cart"
                            ), 200);
                    }

                }catch(Exception $e){
                    return Response::json(
                        array(
                            'Success' =>  false, 
                            'message'   =>  "Something Went Wrong!"
                        ), 500);
                }

                    
            }
        
        public function checkout($userId,$addressId=null)
        {
            try{
                if(!$addressId)
                {
                    $addressId=Address::where(['user_id'=>$userId,'address_type'=>'primary'])->pluck('address_id')->first();
                    if($addressId){
                        //$order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->update(['address_id'=>$addressId]);
                    }
                }
            $count = AppUser::where('user_id', $userId)->count();
                    if($count==0){
                        return Response::json(
                            array(
                                'Success' =>  false,
                                'message'   =>  "User Not Found"
                            ), 404);
                    }

                    $order=Order::where(['user_id'=> $userId, 'order_status'=>'cart' ])->update(['order_status'=>'ordered','address_id'=>$addressId]);
                    if($order==1){
                        return Response::json(
                            array(
                                'Success' =>  true,
                                'message'   =>  "Order Placed"
                            ), 200);
                    }
                    else{
                        return Response::json(
                            array(
                                'Success' =>  false,
                                'message'   =>  "No item in cart"
                            ), 500);
                    }

        }catch(Exception $e){
            return Response::json(
                array(
                    'Success' =>  false,
                    'message'   =>  "Something went wrong!"
                ), 500);
        }
    }
        }
