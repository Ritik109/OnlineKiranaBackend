<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Route;


class ManageProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $results = Product::all();
        //return $results;
        foreach($results as $result)
        {
            $result['category_id']=Category::where('cate_id',$result['category_id'])->first()->name_in_eng;
            $result['image_url']=url('/')."/product_images/".$result['image_url'];

        }
        //return $results;
        return view('product.product',['categoryData'=>$results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates=Category::all();
        return view('product.product-add',['categoryData'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            
            $validatedData = $request->validate([
                'name_in_eng' => 'required|max:255',
                'name_in_hin' => 'required',
                'category_id' => 'required',
                'quantity' => 'required',
                'brand' => 'required',
                'mrp' => 'required',
                'price' => 'required',
                
            ]);
            $newProduct=new Product([
                'product_id'=>NULL,
                'name_in_eng'=>$request->get('name_in_eng'),
                'name_in_hin'=>$request->get('name_in_hin'),
                'category_id'=>$request->get('category_id'),
                'quantity'=>$request->get('quantity'),
                'brand'=>$request->get('brand'),
                'mrp'=>$request->get('mrp'),
                'price'=>$request->get('price')
                
            ]);
            $newProduct->save();
            
            if($request->hasFile('image_url'))
            {
               
                $validatedData = $request->validate([
                    'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);
                request()->image_url->move(public_path('product_images'), $newProduct->product_id.'.'.'jpg');
            Product::where('product_id',$newProduct->product_id)
            ->first()
            ->update(array(
                'image_url' => $newProduct->product_id.'.'.'jpg'
                ));
            } 
                       
            return redirect('manage-product');
            }
            catch(Exception $e)
            {
                return $e;
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($prod_id)
    {
        //
        $product=Product::where('product_id',$prod_id)->first();
        $cates=Category::all();
        return view('product.product-edit',['product'=>$product,'categoryData'=>$cates]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $prod_id)
    {
        //
        try{
            $validatedData = $request->validate([
                'name_in_eng' => 'required|max:255',
                'name_in_hin' => 'required',
                'category_id' => 'required',
                'quantity' => 'required',
                'brand' => 'required',
                'mrp' => 'required',
                'price' => 'required'
            ]);
            $page = Product::where('product_id',$prod_id)
            ->first()
            ->update(array(
                'name_in_eng'=>$request->get('name_in_eng'),
                'name_in_hin'=>$request->get('name_in_hin'),
                'category_id'=>$request->get('category_id'),
                'description'=>$request->get('description'),
                'quantity'=>$request->get('quantity'),
                'brand'=>$request->get('brand'),
                'mrp'=>$request->get('mrp'),
                'price'=>$request->get('price')
            ));
            return redirect('manage-product');
            }
            catch(Exception $e)
            {
                return redirect('manage-product');
            }
    }

    public function updateImage(Request $request)

    {
        try{

        request()->validate([
            
            'product_id' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        request()->image_url->move(public_path('product_images'), $request->get('product_id').'.'.'jpg');
        Product::where('product_id',$request->get('product_id'))
        ->first()
        ->update(array(
            'image_url' => $request->get('product_id').'.'.'jpg'
            ));

            return redirect('manage-product');
        
        }
        catch(Exception $e)
        {
            return back()
        ->with('success','You have successfully upload image.')
        ->with('image',$request->get('product_id'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($prod_id)
    {
        //
        Product::where('product_id',$prod_id)->delete();
        return redirect('manage-product');
    }
}
