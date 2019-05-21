<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create()
    {


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $response = array();

        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|max:50',
            'middle_name' => 'bail|max:50',
            'last_name' => 'bail|required|max:50',
            'gender' => 'bail|required|max:50',
            'email' => 'bail|required|email|max:50|unique:users,email',
            'phone_no' => 'bail|required|max:20|min:10|unique:users,phone_no',
            'id_no' => 'bail|required|unique:users,id_no|min:7|max:10',
            'password' => 'bail|required'
        ]);

        if (!$validator->passes()) {
            $response['success'] = 0;
            $response['message'] = $validator->errors()->all();
        } else {

            $phone_no = convert_phone_to_kenyan_format($request->phone_no);

            $user = new  User();
            $user->id_no = $request->id_no;
            $user->first_name = strtoupper($request->first_name);
            $user->last_name = strtoupper($request->last_name);
            $user->middle_name = strtoupper($request->middle_name);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_no = $phone_no;
            $user->save();


            if ($user) {
                $response['success'] = 1;
                $response['message'] = "successfully saved user";
            } else {
                $response['success'] = 0;
                $response['message'] = "failed to saved user";
            }
        }

        return response()->json($response);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
