<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Response;

class ManageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryTableData = Category::all();
        foreach($categoryTableData as $category)
        {
            $category['cate_icon_url']=url('/')."/category_images/".$category['cate_icon_url'];

        }
        return view('category.category',['categoryData'=>$categoryTableData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.categoryadd');
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
        //return Response::json($request);
        try{
        $validatedData = $request->validate([
            'name_in_eng' => 'required|max:255',
            'name_in_hin' => 'required',
        ]);
        $newCategory=new Category([
            'cate_id'=>NULL,
            'name_in_eng'=>$request->get('name_in_eng'),
            'name_in_hin'=>$request->get('name_in_hin'),
            'details'=>$request->get('details')
        ]);
        $newCategory->save();
        return redirect('manage-category');
        }
        catch(Exception $e)
        {
            return redirect('manage-category');
        }
        
    }

    public function imageUploadPost(Request $request)

    {
        try{
        request()->validate([
            
            'cate_id' => 'required',
            'cate_icon_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        request()->cate_icon_url->move(public_path('category_images'), $request->get('cate_id').'.'.'jpg');
        Category::where('cate_id',$request->get('cate_id'))
        ->first()
        ->update(array(
            'cate_icon_url' => $request->get('cate_id').'.'.'jpg'
            ));
            return redirect('manage-category');
        }
        catch(Exception $e){
        return back()
        ->with('success','unable to update image')
        ->with('image',$request->get('cate_id'));
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
    public function edit($cateId)
    {
        //
         $toEditCate=Category::where('cate_id',$cateId)->first();
        $toEditCate['cate_icon_url']=url('/')."/category_images/".$toEditCate['cate_icon_url'];
        return view('category.categoryedit', ['categoryId' => $toEditCate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return Response::json((int)$request->get('cate_id'));
        try{
    $validatedData = $request->validate([
        'cate_id' =>'required',
        'name_in_eng' => 'required|max:255',
        'name_in_hin' => 'required',
    ]);
        $page = Category::where('cate_id',$request->get('cate_id'))
        ->first()
        ->update(array(
            'name_in_eng' => $request->get('name_in_eng'),
            'name_in_hin' => $request->get('name_in_hin'),
            'details' => $request->get('details')
        ));

        return redirect('manage-category');
    }
    catch(Exception $e)
    {
        return back()
        ->with('success','failed');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Category::where('cate_id',$id)->delete();
        return redirect('manage-category');

    }
}
