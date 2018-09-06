<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('loginTest', function (Request $request) {
    $data = $request->only(['username', 'email', 'password']);
    $validator = \Illuminate\Support\Facades\Validator::make($data, [
        'email'    => 'required|email',
        'password' => 'required|min:6'
    ]);

    if ($validator->fails()) {
        return [
            'failed'
        ];
    }
    if (!$token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($data)) {
        return [
            'failed token'
        ];
    }

    return [
        $token
    ];
});
Route::post('getSth', function (Request $request) {
    return [
        'logged in',
        \Illuminate\Support\Facades\Auth::user(),
    ];
});
