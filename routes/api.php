<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthentificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::post('/post-login-api', [AuthentificationController::class,'LoginAPi']);

// client routes
Route::middleware('auth:sanctum')->get('/chatbot',[ClientController::class,'chatbot']);

Route::middleware('auth:sanctum')->get('/products',[ClientController::class,'products']);

Route::middleware('auth:sanctum')->post('/send_form',[ClientController::class,'send_form']);

Route::middleware('auth:sanctum')->get('/forms',[ClientController::class,'forms']);


