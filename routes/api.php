<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'API\UserController@login'); //Login
Route::post('register', 'API\UserController@register'); //Register

Route::group(['middleware' => 'auth:api'], function(){ //Only authenticated users can access

    Route::post('logout','API\UserController@logout'); //Logout

    Route::prefix('/users')->group(function () { //Grouping users paths
        Route::get('/', 'API\UserController@getDetailUser'); //Get detail from login user
        Route::get('/{user_id}', 'API\UserController@getDetailOtherUser'); //Get detail from login user
        Route::get('/{user_id}/courses', 'API\UserController@getAllUserCourse'); //Get other user courses
    });

    Route::prefix('/courses')->group(function () { //Grouping Courses paths
        Route::get('/', 'API\CourseController@getAll'); //Get all user's Course
        Route::post('/', 'API\CourseController@store')->middleware('auth.teacher'); //Create a new Course
        Route::post('/{course_id}/enroll', 'API\CourseController@enroll')->middleware('auth.student')->middleware('auth.enroll');//Enroll a course

        Route::group(['middleware' => 'auth.course'], function(){//Grouping courses auth
            Route::get('/{course_id}', 'API\CourseController@show'); //Get Course for given id
            Route::put('/{course_id}', 'API\CourseController@update')->middleware('auth.teacher')->middleware('course.owner'); //Update Course for given id
            Route::delete('/{course_id}', 'API\CourseController@destroy')->middleware('auth.teacher')->middleware('course.owner'); //Delete Course for given id
            Route::get('/{course_id}/status', 'API\CourseController@getStatus')->middleware('course.open'); //Get Course status (open/close)
            Route::get('{course_id}/users', 'API\CourseController@getUsers');//Get all users who has enrolled in this course 
       
            Route::get('/{course_id}/attend', 'API\AttendanceController@getAll'); //Get all attend in Course for given id
            Route::post('/{course_id}/attend', 'API\AttendanceController@store')->middleware('course.open'); //Attend a Course for given id
            Route::get('/{course_id}/attend/status', 'API\AttendanceController@getStatus'); //Get user's Course attendance status for given id (attended/not-attended)
            Route::get('/{course_id}/attend/users', 'API\AttendanceController@getUsers')->middleware('auth.teacher'); //Get user's Course attendance status for given id (attended/not-attended)

            Route::get('/{course_id}/materials', 'API\MaterialController@getAll'); //Get all materials from the course
            Route::post('/{course_id}/materials', 'API\MaterialController@store')->middleware('auth.teacher'); //Create new material in Course for given id

            Route::group(['middleware' => 'course.material'], function(){//Grouping Materials paths
                Route::get('/{course_id}/materials/{material_id}', 'API\MaterialController@show'); //Get a material
                Route::put('/{course_id}/materials/{material_id}', 'API\MaterialController@update')->middleware('auth.teacher')->middleware('course.owner'); //Update a material
                Route::delete('/{course_id}/materials/{material_id}', 'API\MaterialController@destroy')->middleware('auth.teacher')->middleware('course.owner');//Delete a material

                Route::get('/{course_id}/materials/{material_id}/file', 'API\FileController@getAllShareable');//Get all shareable file
                Route::post('/{course_id}/materials/{material_id}/file', 'API\FileController@storeShareable')->middleware('auth.teacher');//Upload a shareable file
                Route::get('/{course_id}/materials/{material_id}/file/{file_id}', 'API\FileController@show')->middleware('file.shareable');//Download the shareable file
                Route::delete('/{course_id}/materials/{material_id}/file/{file_id}', 'API\FileController@destroy')->middleware('auth.teacher')->middleware('file.shareable');//Delete a shareable file

                Route::get('/{course_id}/materials/{material_id}/submit', 'API\FileController@getAllSubmit');//Get all submited file
                Route::post('/{course_id}/materials/{material_id}/submit', 'API\FileController@storeSubmit')->middleware('auth.student');//Upload a submit file
                Route::get('/{course_id}/materials/{material_id}/submit/{file_id}', 'API\FileController@show')->middleware('file.submit');//Download the submited file
                Route::delete('/{course_id}/materials/{material_id}/submit/{file_id}', 'API\FileController@destroy')->middleware('file.owner|teacher')->middleware('file.submit');//Delete a submit file
            });
        });
    }); 
});

//Response if page not found
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

