<?php

namespace App\Http\Controllers\Api;

use Response;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Address;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        //
        try{
            $all_addresses=Address::where('user_id',$userId)->get();
            if($all_addresses==null){
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => [],
                        'message'   =>  "No Adressess Available"
                    ), 200);
                    }                
            return Response::json(
                array(
                    'Success' =>  true,
                    'data' => $all_addresses,
                    'message'   =>  "All Addresses fetched successfully"
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$userId)
    {
        //
        try{
            $validatedData = $request->validate([
                'locality' => 'required|max:255',
                'landmark' => 'required',
                'addressType'=>'required'
            ]);
            $newAddress=new Address([
                'address_id'=>NULL,
                'user_id'=>$userId,
                'locality'=>$request->get('locality'),
                'landmark'=>$request->get('landmark'),
                'address_type'=>$request->get('addressType')
            ]);
            $newAddress->save();
            return Response::json(
                array(
                    'Success' =>  true,
                    'data' => [],
                    'message'   =>  "Address saved successfully"
                ), 200);
            }
            catch(Exception $e)
            {
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  "Somethings wrong"
                    ), 400);
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
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $addressId)
    {
        //
        try{
            $validatedData = $request->validate([
                'locality' => 'required|max:255',
                'landmark' => 'required|min:8',
                'addressType'=>'required'
            ]);
                $page = Address::where('address_id',$addressId)
                ->first()
                ->update(array(
                    'locality' => $request->get('locality'),
                    'landmark' => $request->get('landmark'),
                    'address_type' => $request->get('addressType')
                ));
        
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => [],
                        'message'   =>  'Address updated successfully'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($addressId)
    {
        //
        Address::where('address_id',$addressId)->delete();
        return Response::json(
            array(
                'Success' =>  true,
                'data' => [],
                'message'   =>  'Deleted'
            ), 200);
    }
}
