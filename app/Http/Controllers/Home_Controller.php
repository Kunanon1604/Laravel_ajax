<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home_Controller extends Controller
{
	function __construct()
	{
		#code
	}

	//Index
	public function index()
	{	
		$data['query'] = DB::table('member')->get();
		return view('index',compact('data'));
	}

	//Insert
	public function store(Request $request)
	{
		if($request->ajax()){

			$form = $request->all();
			$data = array(
				'firstname' => $form['firstname'],
				'lastname' => $form['lastname'],
				'phone' => $form['phone'],
				'email' => $form['email']
			);

			$result = DB::table('member')->insert($data);
			if($result){
				return response()->json(array('status' => 200));
			}else{
				return response()->json(array('status' => 400));
			}

		}

	}

	//Delete
	public function delete(Request $request)
	{
		if($request->ajax()){

			$where = array('id' => $request->input('id')); //Condition Query
			$result = DB::table('member')->where($where)->delete(); //Sql 
			if($result){
				return response()->json(array('status' => 200));
			}else{
				return response()->json(array('status' => 400));
			}

		}
	}

}



