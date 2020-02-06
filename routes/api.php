<?php

Route::post('login', 'API\UserController@login'); //Login
Route::post('register', 'API\UserController@register'); //Register

Route::group(['middleware' => 'auth:api'], function(){ //Only authenticated users can access

    Route::post('logout','API\UserController@logout'); //Logout

    Route::prefix('/user')->group(function () { //Grouping user paths
        Route::post('details', 'API\UserController@details'); //Get detail from login user
    });

    Route::prefix('/kelas')->group(function () { //Grouping kelas paths
        Route::get('/', 'API\KelasController@getAllKelas'); //Get all user's Kelas
        Route::post('/', 'API\KelasController@postCreateKelas')->middleware('auth.teacher'); //Create a new Kelas

        Route::get('/{kelas_id}', 'API\KelasController@getOneKelas')->middleware('auth.kelas'); //Get kelas for given id
        Route::put('/{kelas_id}', 'API\KelasController@putUpdateKelas')->middleware('auth.kelas')->middleware('auth.teacher')->middleware('auth.owner'); //Update kelas for given id
        Route::delete('/{kelas_id}', 'API\KelasController@deleteOneKelas')->middleware('auth.kelas')->middleware('auth.teacher')->middleware('auth.owner'); //Delete kelas for given id
        Route::get('/{kelas_id}/status', 'API\KelasController@getStatusKelas')->middleware('auth.kelas'); //Get kelas status (open/close)

        Route::get('/{kelas_id}/attend', 'API\AttendanceController@getAllAttend')->middleware('auth.kelas'); //Get all attend in kelas for given id
        Route::post('/{kelas_id}/attend', 'API\AttendanceController@postCreateAttend')->middleware('auth.kelas')->middleware('kelas.open'); //Attend a kelas for given id
        Route::get('/{kelas_id}/attend/status', 'API\AttendanceController@getStatusAttend')->middleware('auth.kelas'); //Get user's kelas attendance status for given id (attended/not-attended)

        Route::get('/{kelas_id}/file', 'API\KelasController@Getkelas'); //Get all file uploaded in kelas for given id
        Route::post('/{kelas_id}/file', 'API\KelasController@Getkelas'); //Upload file in kelas for given id

        //Fitur tambahan
        Route::get('/{kelas_id}/homework', 'API\KelasController@Getkelas'); //Get all homework in kelas for given id
        Route::post('/{kelas_id}/homework', 'API\KelasController@Getkelas'); //Create new homework in kelas for given id
        Route::get('/{kelas_id}/homework/{homework_id}', 'API\KelasController@Getkelas'); //Get all file uploaded in kelas for given id

    }); 
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});
