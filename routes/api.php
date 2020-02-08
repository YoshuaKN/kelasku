<?php
/*
    FITUR BELUM JADI :
        1. MATERI / TUGAS TIAP KELAS @Route V
        2. UPLOAD FILE GURU (BISA DILIHAT SEMUA ORANG YANG BERADA DI KELAS TERSEBUT)
        3. UPLOAD FILE SISWA (UNTUK MENGIRIMKAN TUGAS KE GURU DAN HANYA DAPAT DILIHAT OLEH GURU DAN SISWA PENGIRIM)
        4. LIHAT DAFTAR ORANG DALAM SATU KELAS @Route V
        5. GURU LIHAT DAFTAR HADIR TIAP SISWA  @Route V
        6. ENROLL DALAM KELAS @Route V
        7. GET KELAS DARI USER TERTENTU @Route V

    FILE GET TYPE
        1. USER GET ALL SHAREABLE -> GENERATE LINKS FOR ONE SHAREABLE FILE
            1.1 USER GET ONE SHAREABLE
        2. USER GET HIS/HER OWN SUBMISION -> GENERATE LINKS FOR ONE SUBMISSION
            2.1 USER GET ONE SUBMISSION
        3. TEACHER GET ALL SUBMISSION -> GENERATE LINKS FOR ONE SUBMISSION
            3.1 TEACHER GET ONE SUBMISSION

    PERLU DI EDIT
        1. OBSERVER KELAS DELETE (UNTUK MATERIAL DAN FILE)
        2. OBSERVER MATERIAL
        3. OBSERVER FILE
*/

use Illuminate\Support\Facades\Route;

Route::post('login', 'API\UserController@login'); //Login
Route::post('register', 'API\UserController@register'); //Register

Route::group(['middleware' => 'auth:api'], function(){ //Only authenticated users can access

    Route::post('logout','API\UserController@logout'); //Logout

    Route::prefix('/user')->group(function () { //Grouping user paths
        Route::get('/', 'API\UserController@getDetailsLoginUser'); //Get detail from login user
        Route::get('/{user_id}', 'API\UserController@getDetailUser'); //Get detail from login user
        Route::get('/{user_id}/kelas', 'API\UserController@getAllKelasUser'); 
    });

    Route::prefix('/kelas')->group(function () { //Grouping kelas paths
        Route::get('/', 'API\KelasController@getAllKelas'); //Get all user's Kelas
        Route::post('/', 'API\KelasController@postCreateKelas')->middleware('auth.teacher'); //Create a new Kelas
        Route::post('{kelas_id}/enroll', 'API\KelasController@postEnrollKelas')->middleware('auth.enroll');

        Route::group(['middleware' => 'auth.kelas'], function(){
            Route::get('/{kelas_id}', 'API\KelasController@getOneKelas'); //Get kelas for given id
            Route::put('/{kelas_id}', 'API\KelasController@putUpdateKelas')->middleware('auth.teacher')->middleware('course.owner'); //Update kelas for given id
            Route::delete('/{kelas_id}', 'API\KelasController@deleteOneKelas')->middleware('auth.teacher')->middleware('course.owner'); //Delete kelas for given id
            Route::get('{kelas_id}/users', 'API\KelasController@getUsersKelas');
            Route::get('/{kelas_id}/status', 'API\KelasController@getStatusKelas')->middleware('kelas.open'); //Get kelas status (open/close)
            // Route::get('{kelas_id}/users/{user_id}', 'API\KelasController@getOneUserKelas')->middleware('auth.kelas');

            Route::get('/{kelas_id}/attend', 'API\AttendanceController@getAllAttend'); //Get all attend in kelas for given id
            Route::post('/{kelas_id}/attend', 'API\AttendanceController@postCreateAttend')->middleware('kelas.open'); //Attend a kelas for given id
            Route::get('/{kelas_id}/attend/status', 'API\AttendanceController@getStatusAttend'); //Get user's kelas attendance status for given id (attended/not-attended)
            Route::get('/{kelas_id}/attend/users', 'API\AttendanceController@getAllUsersAttend')->middleware('auth.teacher'); //Get user's kelas attendance status for given id (attended/not-attended)

            Route::get('/{kelas_id}/material', 'API\MaterialController@getAllMaterials'); //Get all material in kelas for given id
            Route::post('/{kelas_id}/material', 'API\MaterialController@postCreateMaterial')->middleware('auth.teacher'); //Create new material in kelas for given id

            Route::group(['middleware' => 'kelas.material'], function(){
                Route::get('/{kelas_id}/material/{material_id}', 'API\MaterialController@getOneMaterial');
                Route::put('/{kelas_id}/material/{material_id}', 'API\MaterialController@putUpdateMaterial')->middleware('auth.teacher')->middleware('course.owner'); 
                Route::delete('/{kelas_id}/material/{material_id}', 'API\MaterialController@deleteOneMaterial')->middleware('auth.teacher')->middleware('course.owner');

                Route::get('/{kelas_id}/material/{material_id}/file', 'API\FileController@getAllShareableFile');
                Route::post('/{kelas_id}/material/{material_id}/file', 'API\FileController@postUploadShareableFile')->middleware('auth.teacher'); 
                Route::get('/{kelas_id}/material/{material_id}/file/{file_id}', 'API\FileController@getOneFile')->middleware('file.shareable');
                Route::delete('/{kelas_id}/material/{material_id}/file/{file_id}', 'API\FileController@deleteOneFile')->middleware('file.owner|teacher')->middleware('file.shareable');

                Route::get('/{kelas_id}/material/{material_id}/file/submit', 'API\FileController@getAllSubmitFile');
                Route::post('/{kelas_id}/material/{material_id}/file/submit', 'API\FileController@postUploadSubmitFile');
                Route::get('/{kelas_id}/material/{material_id}/file/submit/{file_id}', 'API\FileController@getOneFile')->middleware('file.submit');
                Route::delete('/{kelas_id}/material/{material_id}/file/submit/{file_id}', 'API\FileController@deleteOneFile')->middleware('file.owner|teacher')->middleware('file.submit');
            });
        });
    }); 
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

