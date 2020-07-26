<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUser;
use Illuminate\Support\Facades\Validator;
use Response;
Use Exception;

class LoginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateCred(Request $request)
    {
        $validationStatus = $this->loginRules();
        if($validationStatus->getData()->Success == true)
        {
            try{
                $password = AppUser::where('phone', $request->get('phone'))->get(['password']);
                $password = $password[0]->password;
                if($password == $request->get('password')){
                    return Response::json(
                        array(
                            'Success' =>  true,
                            'data' => [],
                            'message'   =>  "user verified"
                        ), 200);
                }
                else{
                    return Response::json(
                        array(
                            'Success' =>  false,
                            'data' => [],
                            'message'   =>  "password is incorrect"
                        ), 400);
                }

            }
            catch(Exception $e)
            {
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  "No Record found for this phone"
                    ), 405);
            }

    }
}
    public function loginRules()
    {
        try{
            $validator = Validator::make(Request()->all(),[
                'phone'=> 'required',
                'password'=>'required',
                
            ]);
            if ($validator->fails()){
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  $validator->messages()->toArray()
                    ), 400);    
            }
            else{
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => [],
                        'message'   =>  'Fields Validated'
                    ), 200); 
            }
             }
             catch(Exception $e)
             {
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  "Server Error/BAD Request/SQL Error"
                    ), 405);
            }
    }
}
