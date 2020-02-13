# Kelasku

## Auth
### Register
    - Method : POST.
    - URL : /api/register
    - Request : 
        | key | constrain |
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
        | key | constrain |
        | ------ | ------ |
        | email | Required, Value = email format (example@kelasku.com). |
        | password | Required, MIN = 8 character. |

### Logout
    - Method : POST.
    - URL : /api/logout

## User

### Get your own user profile
    - Method : GET.
    - URL : /api/user

### Get other user profile
    - Method : GET.
    - URL : /api/users/{user_id}

### Get other user courses
    - Method : GET.
    - URL : /api/users/{user_id}/courses

## Course
### Get all the courses that you have enrolled / created
    - Method : GET.
    - URL : /api/courses

### Create a new course
    - Method : POST.
    - URL : /api/courses
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 255 character. |
        | day | Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, ... , 6 : Saturday) |
        | time_start | Required, Value = date format H:i (example : 07:00). |
        | time_end | Required, Value = date format H:i (example : 13:00), This value must bigger than time_start. |

### Get a course that you have enrolled /created
    - Method : GET.
    - URL : /api/courses/{course_id}

### Update a course
    - Method : PUT.
    - URL : /api/courses/{course_id}
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 255 character. |
        | day | Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, ... , 6 : Saturday) |
        | time_start | Required, Value = date format H:i (example : 07:00). |
        | time_end | Required, Value = date format H:i (example : 13:00), This value must bigger than time_start. |

### Delete a course
    - Method : DELETE.
    - URL : /api/courses/{course_id}

### Enroll a course
    - Method : POST.
    - URL : /api/courses/{course_id}/enroll

### Get course status (open/close)
    - Method : GET.
    - URL : /api/courses/{course_id}/status

### Get all users who has enrolled in this course
    - Method : GET.
    - URL : /api/courses/{course_id}/users


## Attend
### Attend a course
    - Method : POST.
    - URL : /api/courses/{course_id}/attend

### Get all attend in the course before
    - Method : GET.
    - URL : /api/courses/{course_id}/attend

### Get attend status 
    - Method : GET.
    - URL : /api/courses/{course_id}/attend/status

### Get all the users who have attended
    - Method : GET.
    - URL : /api/courses/{course_id}/attend/users

## Material
### Get all materials from the course
    - Method : GET.
    - URL : /api/courses/{course_id}/materials

### Create a material in the given course
    - Method : POST.
    - URL : /api/courses/{course_id}/materials
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 100 character. |
        | description | Optional |

### Get a material
    - Method : GET.
    - URL : /api/courses/{course_id}/materials/{material_id}

### Update a material
    - Method : PUT.
    - URL : /api/courses/{course_id}/materials/{material_id}
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 100 character. |
        | description | Optional |
        
### Delete a material
    - Method : DELETE.
    - URL : /api/courses/{course_id}/materials/{material_id}


## Shareable File
### Get all shareable file
    - Method : GET.
    - URL : /api/courses/{course_id}/materials/{material_id}/file

### Upload a shareable file
    - Method : POST.
    - URL : /api/courses/{course_id}/materials/{material_id}/file
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 100 character. |
        | file | Required, Value = file type, Mimes : jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf|

### Download the shareable file
    - Method : GET.
    - URL : /api/courses/{course_id}/materials/{material_id}/file/{file_id}

### Delete a shareable file
    - Method : DELETE.
    - URL : /api/courses/{course_id}/materials/{material_id}/file/{file_id}


## Submit File
### Get all submited file
    - Method : GET.
    - URL : /api/courses/{course_id}/materials/{material_id}/submit

### Upload a submit file
    - Method : POST.
    - URL : /api/courses/{course_id}/materials/{material_id}/submit
    - Request : 
        | key | constrain |
        | ------ | ------ |
        | name | Required, MAX = 100 character. |
        | file | Required, Value = file type, Mimes : jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf|

### Download the submited file
    - Method : GET.
    - URL : /api/courses/{course_id}/materials/{material_id}/submit/{file_id}

### Delete a submit file
    - Method : DELETE.
    - URL : /api/courses/{course_id}/materials/{material_id}/submit/{file_id}







