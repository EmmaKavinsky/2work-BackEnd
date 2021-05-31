<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Traits\ApiTrait;
use Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

	use ApiTrait;

	public function register(UserRequest $request)
	{
		$validated = $request->validated();

		$user = new User();
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);

		$user = User::create($input);
		$success['token'] = $user->createToken(config('app.name'))->accessToken;
		$success['user'] = $user->refresh();

		return $this->apiSuccess($success);
	}

	public function login()
	{
		$credentials = [
			'email' => request('email'),
			'password' => request('password')
		];

		if (Auth::attempt($credentials)) {
			$success['token'] = Auth::user()->createToken(config('app.name'))->accessToken;
			$success['user'] = Auth::user();
			return $this->apiSuccess($success);
		}

		return $this->apiError(__('auth.failed'), 401);
	}

	public function updateProfile(UserRequest $request)
	{
		$user = User::where('id', Auth::user()->id)->update($request->all());
		return $this->apiSuccess(['user' => $user]);
	}

	public function updatePassword(UserRequest $request)
	{
		$validated = $request->validate([
			'password' => 'sometimes|required|min:6|max:255'
		]);
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::where('id', Auth::user()->id)->update($input);
		return $this->apiSuccess(['user' => $user]);
	}

	public function getUsers(){
		return $this->apiSuccess(['users' => DB::select('select * from users order by created_at desc limit 6',)]);
	}

}
