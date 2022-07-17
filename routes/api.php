<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\DriversController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\DeliveryRequestsController;
use Illuminate\Support\Facades\Hash;

// Routes for auth users only
Route::middleware('auth:sanctum')->group(function () {
    // Route to get user
    Route::get('/user', [AuthController::class, 'user']);
    // Route to update user info
    Route::post('/user/update', [AuthController::class, 'update']);
    // Route to change user password
    Route::post('/user/changePassword', [AuthController::class, 'updatePassword']);
    // Route to log user out
    Route::get('/user/revoke', function (Request $request) {
        $user =  $request->user();
        $user->tokens()->delete();
        return 'token are deleted';
    });


    // Route to get user all orders
    Route::get('/orders/{userId}', [OrdersController::class, 'getOrders']);
    // Route to get single order
    Route::get('/orders/single/{orderId}', [OrdersController::class, 'getSingleOrder']);
    // Route to create new order
    Route::post('/orders/send', [OrdersController::class, 'store']);
    // Route to delete user order
    Route::get('/orders/delete/{orderId}', [OrdersController::class, 'deleteOrder']);
    // Route to update order status
    Route::post('/order/update', [OrdersController::class, 'updateOrder']);

    // Route to get all  delivery request
    Route::get('/delivery/request/{driverId}', [DeliveryRequestsController::class, 'getDeliveryRequests']);
    // Route to get accepted delivery request
    Route::get('/delivery/request/accepted/{orderId}', [DeliveryRequestsController::class, 'getAcceptedDeliveryRequests']);
    // Route to send new delivery request
    Route::post('/delivery/request/store', [DeliveryRequestsController::class, 'store']);
    // Route to make order complete
    Route::post('/delivery/order/complete', [DeliveryRequestsController::class, 'orderCompelete']);

    // Route to fetch user rating
    Route::get('/evaluation/{userId}',[RatingController::class, 'getUserRating']);
    // Route to make new rating
    Route::post('/evaluation/save',[RatingController::class, 'saveRating']);
});


// to featch all items by category id
Route::get('/items/{categoryId}', [ItemsController::class, 'getItemsByCategory']);

// Route to get app info
Route::get('/settings',[SettingsController::class, 'getInfo']);

// Route to get token
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'phone' => 'required', 
        'password' => 'required',
        'device_name' => 'required',
    ]);
    $user = User::where('phone', $request->phone)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});

// Route to login user in
Route::post('/login', [AuthController::class, 'login']);
// Route to register new user
Route::post('/register', [AuthController::class, 'register']);
// Route to verify user phone
Route::post('/otp/verify', [AuthController::class, 'verifyUser']);
// Route to resend otp code
Route::post('/otp/resend', [AuthController::class, 'resendOtp']);

// Route to get all categories
Route::get('/categories', [CategoriesController::class, 'getAll']);

 // Route to get all orders
 Route::get('/orders/all/{lat}/{lng}', [OrdersController::class, 'getAllOrders']);


