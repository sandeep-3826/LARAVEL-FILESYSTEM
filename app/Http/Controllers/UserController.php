<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\RandomStringTrait;

class UserController extends Controller {

	use RandomStringTrait;

	public function getAllUserDetails() {

		$allUsers = Storage::disk('local')->exists('users.json') ? json_decode(Storage::disk('local')->get('users.json')) : [];

		return view('welcome' , compact('allUsers'));

	}

	public function saveUserDetails(Request $request) {

		//validate input request
		$validator = \Validator::make($request->all(), [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'email' => 'required|email',
	        'password' => 'required'
	    ]);

		if ( $validator->fails() ) {
			return response()->json([
				'status' => 422,
				'errors' => $validator->errors()
			]);
	    }

		try {

			$userId = $this->generateRandomNumber(5);

			$userDetails = Storage::disk('local')->exists('users.json') ? json_decode(Storage::disk('local')->get('users.json')) : [];
        
            $inputData = $request->only(['first_name', 'last_name', 'email','password']);
            $inputData['id'] = $userId;
            $inputData['username'] = strtolower(preg_replace('/\s+/', '', $request->first_name)).'-'.$this->generateRandomNumber(5);
 
            array_push($userDetails,$inputData);
    
            Storage::disk('local')->put('users.json', json_encode($userDetails));

			return response()->json([
				'status' => 201,
				'userId' => $userId,
				'message' => 'Record has been created successfully'
			]);

		} catch (\Exception $e) {

			return response()->json([
				'status' => 500,
				'errors' => $e->getMessage(),
				'message' => 'Something went wrong! please try later'
			]);

		}

	}

	public function editUserDetails(Request $request) {

		//validate input request
		$validator = \Validator::make($request->all(), [
			'user_id' => 'required',
	    ]);

		if ( $validator->fails() ) {
			return response()->json([
				'status' => 422,
				'errors' => $validator->errors()
			]);
	    }

		try {

			$userId = $request->user_id ?? null;

			$userDetails = Storage::disk('local')->exists('users.json') ? json_decode(Storage::disk('local')->get('users.json')) : [];

			foreach ($userDetails as $key => $value) {

				if ($value->id == $userId) {

					$userDetails[$key]->first_name 	= $request->first_name ?? $value->first_name;
					$userDetails[$key]->last_name 	= $request->last_name ?? $value->last_name;
					$userDetails[$key]->email 		= $request->email ?? $value->email;
					$userDetails[$key]->password 	= $request->password ?? $value->password;
					$userDetails[$key]->username 	= strtolower(preg_replace('/\s+/', '', $request->first_name)).'-'.$this->generateRandomNumber(5) ?? $value->username;

				}
				
			}

			Storage::disk('local')->put('users.json', json_encode($userDetails));

			return response()->json([
				'status' => 200,
				'message' => 'Record has been updated successfully'
			]);

		} catch (\Exception $e) {

			return response()->json([
				'status' => 500,
				'message' => 'Something went wrong! please try later'
			]);

		}

	}

	public function initCreateUserForm() {

		return view('create');

	}
    
}
