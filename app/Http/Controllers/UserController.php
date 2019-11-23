<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Response;

class UserController extends Controller
{
    public function index()
    {
        $result=User::all();
        return Response::json(
            array(
                'Success' =>  true ,
                'data' => $result,
                'message'   =>  "Data Fetched"
            ), 405);
    }
    public function insertNewUserDB(Request $request)
    {
       
        $firstname = $request->get('firstname');
        $middlename = $request->get('middlename');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $password=$request->get('password');
        $phone = $request->get('phone');

        DB::insert('insert into users (user_id, firstname, middlename,lastname,email,password,address_id,phone,created_at)  values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [NULL, $firstname,$middlename,$lastname,$email,$password,NULL,$phone,NULL]);
       
       $data=array();
        return "hello";
        /*INSERT INTO `users` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `address_id`, `phone`, `created_at`) 
        VALUES (NULL, 'Amit', NULL, 'Badana', NULL, '', NULL, '7070105020', current_timestamp());*/ 

    }
    
}
