<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth:api', ['except' => ['login']]);
	}

	public function register(Request $request) {

		$request['password'] = \Hash::make($request['password']);
		$user = User::create($request->all());
		$user->save();
		if ($request->type == "personal")$user->notify(new VerifyPhoneNumber(decrypt($user->phone_number_verify_code)));
		$user->token = $user->createToken("OymundoBaseAPI")->accessToken;
		return response()->json($user, 201);

	}

	public function login()
	{
		$credentials = request(['email', 'password']);

		if (! $token = auth('api')->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->respondWithToken($token);
	}

	public function me()
	{
		return response()->json(auth('api')->user());
	}

	public function logout()
	{
		auth('api')->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	public function refresh()
	{
		return $this->respondWithToken(auth('api')->refresh());
	}

	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
		]);
	}
}
