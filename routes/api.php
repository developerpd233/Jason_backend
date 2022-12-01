<?php
// dd('aaa');
Route::post('users/addUser/1', 'Api\V1\Admin\AuthApiController@signup');
Route::post('users/verifyOtp',  'Api\V1\Admin\AuthApiController@otpverify');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');
    Route::post('users/uploadImage', 'UsersApiController@uploadImage');

});
