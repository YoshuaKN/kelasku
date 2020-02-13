<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'API\UserController@login'); //Login
Route::post('register', 'API\UserController@register'); //Register

Route::group(['middleware' => 'auth:api'], function(){ //Only authenticated users can access

    Route::post('logout','API\UserController@logout'); //Logout

    Route::prefix('/user')->group(function () { //Grouping user paths
        Route::get('/', 'API\UserController@getDetailsLoginUser'); //Get detail from login user
        Route::get('/{user_id}', 'API\UserController@getDetailUser'); //Get detail from login user
        Route::get('/{user_id}/course', 'API\UserController@getAllCourseUser'); 
    });

    Route::prefix('/course')->group(function () { //Grouping Course paths
        Route::get('/', 'API\CourseController@getAllCourse'); //Get all user's Course
        Route::post('/', 'API\CourseController@postCreateCourse')->middleware('auth.teacher'); //Create a new Course
        Route::post('/{course_id}/enroll', 'API\CourseController@postEnrollCourse')->middleware('auth.student')->middleware('auth.enroll');

        Route::group(['middleware' => 'auth.course'], function(){
            Route::get('/{course_id}', 'API\CourseController@getOneCourse'); //Get Course for given id
            Route::put('/{course_id}', 'API\CourseController@putUpdateCourse')->middleware('auth.teacher')->middleware('course.owner'); //Update Course for given id
            Route::delete('/{course_id}', 'API\CourseController@deleteOneCourse')->middleware('auth.teacher')->middleware('course.owner'); //Delete Course for given id
            Route::get('{course_id}/users', 'API\CourseController@getUsersCourse');
            Route::get('/{course_id}/status', 'API\CourseController@getStatusCourse')->middleware('course.open'); //Get Course status (open/close)
            // Route::get('{course_id}/users/{user_id}', 'API\CourseController@getOneUserCourse')->middleware('auth.Course');

            Route::post('/{course_id}/attend', 'API\AttendanceController@postCreateAttend')->middleware('course.open'); //Attend a Course for given id
            Route::get('/{course_id}/attend', 'API\AttendanceController@getAllAttend'); //Get all attend in Course for given id
            Route::get('/{course_id}/attend/status', 'API\AttendanceController@getStatusAttend'); //Get user's Course attendance status for given id (attended/not-attended)
            Route::get('/{course_id}/attend/users', 'API\AttendanceController@getAllUsersAttend')->middleware('auth.teacher'); //Get user's Course attendance status for given id (attended/not-attended)

            Route::get('/{course_id}/material', 'API\MaterialController@getAllMaterials'); //Get all material in Course for given id
            Route::post('/{course_id}/material', 'API\MaterialController@postCreateMaterial')->middleware('auth.teacher'); //Create new material in Course for given id

            Route::group(['middleware' => 'course.material'], function(){
                Route::get('/{course_id}/material/{material_id}', 'API\MaterialController@getOneMaterial');
                Route::put('/{course_id}/material/{material_id}', 'API\MaterialController@putUpdateMaterial')->middleware('auth.teacher')->middleware('course.owner'); 
                Route::delete('/{course_id}/material/{material_id}', 'API\MaterialController@deleteOneMaterial')->middleware('auth.teacher')->middleware('course.owner');

                Route::get('/{course_id}/material/{material_id}/file', 'API\FileController@getAllShareableFile');
                Route::post('/{course_id}/material/{material_id}/file', 'API\FileController@postUploadShareableFile')->middleware('auth.teacher'); 
                Route::get('/{course_id}/material/{material_id}/file/{file_id}', 'API\FileController@getOneFile')->middleware('file.shareable');
                Route::delete('/{course_id}/material/{material_id}/file/{file_id}', 'API\FileController@deleteOneFile')->middleware('file.owner|teacher')->middleware('file.shareable');

                Route::get('/{course_id}/material/{material_id}/file/submit', 'API\FileController@getAllSubmitFile');
                Route::post('/{course_id}/material/{material_id}/file/submit', 'API\FileController@postUploadSubmitFile');
                Route::get('/{course_id}/material/{material_id}/file/submit/{file_id}', 'API\FileController@getOneFile')->middleware('file.submit');
                Route::delete('/{course_id}/material/{material_id}/file/submit/{file_id}', 'API\FileController@deleteOneFile')->middleware('file.owner|teacher')->middleware('file.submit');
            });
        });
    }); 
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

