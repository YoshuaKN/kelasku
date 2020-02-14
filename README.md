# Kelasku

## Auth
### Register
- Method : POST.
- URL : /api/register
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 255 character. |
    | user_type | Required, Value = T or S (T = Teacher, S = Student). |
    | email | Required, Value = email format (example@kelasku.com). |
    | password | Required, MIN = 8 character. |
    | c_password | Required, must have same value with password. |

### Login
- Method : POST.
- URL : /api/login
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | email | Required, Value = email format (example@kelasku.com). |
    | password | Required, MIN = 8 character. |
- Return : Token for login.

### Logout
- Usage : Logout from the current user. (It will delete OauthAcessToken)
- Method : POST.
- URL : /api/logout
- Rules : 
    - Must Authenticated.

## User
### Get your own user profile
- Method : GET.
- URL : /api/user
- Rules : 
    - Must Authenticated.

### Get other user profile
- Method : GET.
- URL : /api/users/{user_id}
- Rules : 
    - Must Authenticated.

### Get other user courses
- Method : GET.
- URL : /api/users/{user_id}/courses
- Rules : 
    - Must Authenticated.

## Course
### Get all the courses that you have enrolled / created
- Method : GET.
- URL : /api/courses
- Rules : 
    - Must Authenticated.

### Enroll a course
- Method : POST.
- URL : /api/courses/{course_id}/enroll
- Rules : 
    - Must Authenticated.
    - Must be a student.
    - Must not be registerd in this course. 

### Create a new course
- Method : POST.
- URL : /api/courses
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 255 character. |
    | day | Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, ... , 6 : Saturday) |
    | time_start | Required, Value = date format H:i (example : 07:00). |
    | time_end | Required, Value = date format H:i (example : 13:00), This value must bigger than time_start. |
- Rules : 
    - Must Authenticated.
    - Must be a teacher.

### Get a course that you have enrolled /created
- Method : GET.
- URL : /api/courses/{course_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 

### Update a course
- Method : PUT.
- URL : /api/courses/{course_id}
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 255 character. |
    | day | Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, ... , 6 : Saturday) |
    | time_start | Required, Value = date format H:i (example : 07:00). |
    | time_end | Required, Value = date format H:i (example : 13:00), This value must bigger than time_start. |
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Must be a teacher.
    - Must be the course owner.

### Delete a course
- Method : DELETE.
- URL : /api/courses/{course_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Must be a teacher.
    - Must be the course owner.

### Get course status (open/close)
- Method : GET.
- URL : /api/courses/{course_id}/status
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Can only be done when the class is opened

### Get all users who has enrolled in this course
- Method : GET.
- URL : /api/courses/{course_id}/users
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 

## Attend
### Attend a course
- Method : POST.
- URL : /api/courses/{course_id}/attend
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Can only be done when the class is opened

### Get all attend in the course before
- Method : GET.
- URL : /api/courses/{course_id}/attend
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 

### Get attend status 
- Method : GET.
- URL : /api/courses/{course_id}/attend/status
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 

### Get all the users who have attended
- Method : GET.
- URL : /api/courses/{course_id}/attend/users
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Must be a teacher.


## Material
### Get all materials from the course
- Method : GET.
- URL : /api/courses/{course_id}/materials
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 

### Create a material in the given course
- Method : POST.
- URL : /api/courses/{course_id}/materials
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 100 character. |
    | description | Optional |
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Must be a teacher.

### Get a material
- Method : GET.
- URL : /api/courses/{course_id}/materials/{material_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.

### Update a material
- Method : PUT.
- URL : /api/courses/{course_id}/materials/{material_id}
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 100 character. |
    | description | Optional |
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a teacher.
    - Must be the course owner.

### Delete a material
- Method : DELETE.
- URL : /api/courses/{course_id}/materials/{material_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a teacher.
    - Must be the course owner.

## Shareable File
### Get all shareable file
- Method : GET.
- URL : /api/courses/{course_id}/materials/{material_id}/file
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.

### Upload a shareable file
- Method : POST.
- URL : /api/courses/{course_id}/materials/{material_id}/file
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 100 character. |
    | file | Required, Value = file type, Mimes : jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf|
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a teacher.

### Download the shareable file
- Method : GET.
- URL : /api/courses/{course_id}/materials/{material_id}/file/{file_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - The file must be a shareable file.

### Delete a shareable file
- Method : DELETE.
- URL : /api/courses/{course_id}/materials/{material_id}/file/{file_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a teacher.
    - The file must be a shareable file.

## Submit File
### Get all submited file
- Method : GET.
- URL : /api/courses/{course_id}/materials/{material_id}/submit
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.

### Upload a submit file
- Method : POST.
- URL : /api/courses/{course_id}/materials/{material_id}/submit
- Request : 
    | Key | Rules |
    | ------ | ------ |
    | name | Required, MAX = 100 character. |
    | file | Required, Value = file type, Mimes : jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf|
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a student.

### Download the submited file
- Method : GET.
- URL : /api/courses/{course_id}/materials/{material_id}/submit/{file_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - The file must be a submited file.

### Delete a submit file
- Method : DELETE.
- URL : /api/courses/{course_id}/materials/{material_id}/submit/{file_id}
- Rules : 
    - Must Authenticated.
    - User must already be registered in the course. 
    - Material must in the course.
    - Must be a teacher or the file owner.
    - The file must be a submited file.