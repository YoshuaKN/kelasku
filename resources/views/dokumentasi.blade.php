<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dokumentasi</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <h1 class="code-line" data-line-start=0 data-line-end=1><a id="Kelasku_0"></a>Kelasku</h1>
    <h2 class="code-line" data-line-start=2 data-line-end=3><a id="Auth_2"></a>Auth</h2>
    <h3 class="code-line" data-line-start=3 data-line-end=4><a id="Register_3"></a>Register</h3>
    <ul>
        <li class="has-line-data" data-line-start="4" data-line-end="5">Method : POST.</li>
        <li class="has-line-data" data-line-start="5" data-line-end="6">URL : /api/register</li>
        <li class="has-line-data" data-line-start="6" data-line-end="15">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 255 character.</td>
                    </tr>
                    <tr>
                        <td>user_type</td>
                        <td>Required, Value = T or S (T = Teacher, S = Student).</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>Required, Value = email format (<a
                                href="mailto:example@kelasku.com">example@kelasku.com</a>).</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td>Required, MIN = 8 character.</td>
                    </tr>
                    <tr>
                        <td>c_password</td>
                        <td>Required, must have same value with password.</td>
                    </tr>
                </tbody>
            </table>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=15 data-line-end=16><a id="Login_15"></a>Login</h3>
    <ul>
        <li class="has-line-data" data-line-start="16" data-line-end="17">Method : POST.</li>
        <li class="has-line-data" data-line-start="17" data-line-end="18">URL : /api/login</li>
        <li class="has-line-data" data-line-start="18" data-line-end="23">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>email</td>
                        <td>Required, Value = email format (<a
                                href="mailto:example@kelasku.com">example@kelasku.com</a>).</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td>Required, MIN = 8 character.</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="23" data-line-end="25">Return : Token for login.</li>
    </ul>
    <h3 class="code-line" data-line-start=25 data-line-end=26><a id="Logout_25"></a>Logout</h3>
    <ul>
        <li class="has-line-data" data-line-start="26" data-line-end="27">Usage : Logout from the current user. (It will
            delete OauthAcessToken)</li>
        <li class="has-line-data" data-line-start="27" data-line-end="28">Method : POST.</li>
        <li class="has-line-data" data-line-start="28" data-line-end="29">URL : /api/logout</li>
        <li class="has-line-data" data-line-start="29" data-line-end="32">Rules :
            <ul>
                <li class="has-line-data" data-line-start="30" data-line-end="32">Must Authenticated.</li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=32 data-line-end=33><a id="User_32"></a>User</h2>
    <h3 class="code-line" data-line-start=33 data-line-end=34><a id="Get_your_own_user_profile_33"></a>Get your own user
        profile</h3>
    <ul>
        <li class="has-line-data" data-line-start="34" data-line-end="35">Method : GET.</li>
        <li class="has-line-data" data-line-start="35" data-line-end="36">URL : /api/user</li>
        <li class="has-line-data" data-line-start="36" data-line-end="39">Rules :
            <ul>
                <li class="has-line-data" data-line-start="37" data-line-end="39">Must Authenticated.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=39 data-line-end=40><a id="Get_other_user_profile_39"></a>Get other user
        profile</h3>
    <ul>
        <li class="has-line-data" data-line-start="40" data-line-end="41">Method : GET.</li>
        <li class="has-line-data" data-line-start="41" data-line-end="42">URL : /api/users/{user_id}</li>
        <li class="has-line-data" data-line-start="42" data-line-end="45">Rules :
            <ul>
                <li class="has-line-data" data-line-start="43" data-line-end="45">Must Authenticated.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=45 data-line-end=46><a id="Get_other_user_courses_45"></a>Get other user
        courses</h3>
    <ul>
        <li class="has-line-data" data-line-start="46" data-line-end="47">Method : GET.</li>
        <li class="has-line-data" data-line-start="47" data-line-end="48">URL : /api/users/{user_id}/courses</li>
        <li class="has-line-data" data-line-start="48" data-line-end="51">Rules :
            <ul>
                <li class="has-line-data" data-line-start="49" data-line-end="51">Must Authenticated.</li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=51 data-line-end=52><a id="Course_51"></a>Course</h2>
    <h3 class="code-line" data-line-start=52 data-line-end=53><a
            id="Get_all_the_courses_that_you_have_enrolled__created_52"></a>Get all the courses that you have enrolled /
        created</h3>
    <ul>
        <li class="has-line-data" data-line-start="53" data-line-end="54">Method : GET.</li>
        <li class="has-line-data" data-line-start="54" data-line-end="55">URL : /api/courses</li>
        <li class="has-line-data" data-line-start="55" data-line-end="58">Rules :
            <ul>
                <li class="has-line-data" data-line-start="56" data-line-end="58">Must Authenticated.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=58 data-line-end=59><a id="Enroll_a_course_58"></a>Enroll a course</h3>
    <ul>
        <li class="has-line-data" data-line-start="59" data-line-end="60">Method : POST.</li>
        <li class="has-line-data" data-line-start="60" data-line-end="61">URL : /api/courses/{course_id}/enroll</li>
        <li class="has-line-data" data-line-start="61" data-line-end="66">Rules :
            <ul>
                <li class="has-line-data" data-line-start="62" data-line-end="63">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="63" data-line-end="64">Must be a student.</li>
                <li class="has-line-data" data-line-start="64" data-line-end="66">Must not be registerd in this course.
                </li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=66 data-line-end=67><a id="Create_a_new_course_66"></a>Create a new course
    </h3>
    <ul>
        <li class="has-line-data" data-line-start="67" data-line-end="68">Method : POST.</li>
        <li class="has-line-data" data-line-start="68" data-line-end="69">URL : /api/courses</li>
        <li class="has-line-data" data-line-start="69" data-line-end="76">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 255 character.</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, … , 6 : Saturday)</td>
                    </tr>
                    <tr>
                        <td>time_start</td>
                        <td>Required, Value = date format H:i (example : 07:00).</td>
                    </tr>
                    <tr>
                        <td>time_end</td>
                        <td>Required, Value = date format H:i (example : 13:00), This value must bigger than time_start.
                        </td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="76" data-line-end="80">Rules :
            <ul>
                <li class="has-line-data" data-line-start="77" data-line-end="78">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="78" data-line-end="80">Must be a teacher.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=80 data-line-end=81><a
            id="Get_a_course_that_you_have_enrolled_created_80"></a>Get a course that you have enrolled /created</h3>
    <ul>
        <li class="has-line-data" data-line-start="81" data-line-end="82">Method : GET.</li>
        <li class="has-line-data" data-line-start="82" data-line-end="83">URL : /api/courses/{course_id}</li>
        <li class="has-line-data" data-line-start="83" data-line-end="87">Rules :
            <ul>
                <li class="has-line-data" data-line-start="84" data-line-end="85">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="85" data-line-end="87">User must already be registered in the
                    course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=87 data-line-end=88><a id="Update_a_course_87"></a>Update a course</h3>
    <ul>
        <li class="has-line-data" data-line-start="88" data-line-end="89">Method : PUT.</li>
        <li class="has-line-data" data-line-start="89" data-line-end="90">URL : /api/courses/{course_id}</li>
        <li class="has-line-data" data-line-start="90" data-line-end="97">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 255 character.</td>
                    </tr>
                    <tr>
                        <td>day</td>
                        <td>Required, integer, Value = 0 - 6 (0 : Sunday, 1 : Monday, … , 6 : Saturday)</td>
                    </tr>
                    <tr>
                        <td>time_start</td>
                        <td>Required, Value = date format H:i (example : 07:00).</td>
                    </tr>
                    <tr>
                        <td>time_end</td>
                        <td>Required, Value = date format H:i (example : 13:00), This value must bigger than time_start.
                        </td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="97" data-line-end="103">Rules :
            <ul>
                <li class="has-line-data" data-line-start="98" data-line-end="99">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="99" data-line-end="100">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="100" data-line-end="101">Must be a teacher.</li>
                <li class="has-line-data" data-line-start="101" data-line-end="103">Must be the course owner.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=103 data-line-end=104><a id="Delete_a_course_103"></a>Delete a course</h3>
    <ul>
        <li class="has-line-data" data-line-start="104" data-line-end="105">Method : DELETE.</li>
        <li class="has-line-data" data-line-start="105" data-line-end="106">URL : /api/courses/{course_id}</li>
        <li class="has-line-data" data-line-start="106" data-line-end="112">Rules :
            <ul>
                <li class="has-line-data" data-line-start="107" data-line-end="108">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="108" data-line-end="109">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="109" data-line-end="110">Must be a teacher.</li>
                <li class="has-line-data" data-line-start="110" data-line-end="112">Must be the course owner.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=112 data-line-end=113><a id="Get_course_status_openclose_112"></a>Get course
        status (open/close)</h3>
    <ul>
        <li class="has-line-data" data-line-start="113" data-line-end="114">Method : GET.</li>
        <li class="has-line-data" data-line-start="114" data-line-end="115">URL : /api/courses/{course_id}/status</li>
        <li class="has-line-data" data-line-start="115" data-line-end="120">Rules :
            <ul>
                <li class="has-line-data" data-line-start="116" data-line-end="117">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="117" data-line-end="118">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="118" data-line-end="120">Can only be done when the class is
                    opened</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=120 data-line-end=121><a
            id="Get_all_users_who_has_enrolled_in_this_course_120"></a>Get all users who has enrolled in this course
    </h3>
    <ul>
        <li class="has-line-data" data-line-start="121" data-line-end="122">Method : GET.</li>
        <li class="has-line-data" data-line-start="122" data-line-end="123">URL : /api/courses/{course_id}/users</li>
        <li class="has-line-data" data-line-start="123" data-line-end="127">Rules :
            <ul>
                <li class="has-line-data" data-line-start="124" data-line-end="125">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="125" data-line-end="127">User must already be registered in
                    the course.</li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=127 data-line-end=128><a id="Attend_127"></a>Attend</h2>
    <h3 class="code-line" data-line-start=128 data-line-end=129><a id="Attend_a_course_128"></a>Attend a course</h3>
    <ul>
        <li class="has-line-data" data-line-start="129" data-line-end="130">Method : POST.</li>
        <li class="has-line-data" data-line-start="130" data-line-end="131">URL : /api/courses/{course_id}/attend</li>
        <li class="has-line-data" data-line-start="131" data-line-end="136">Rules :
            <ul>
                <li class="has-line-data" data-line-start="132" data-line-end="133">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="133" data-line-end="134">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="134" data-line-end="136">Can only be done when the class is
                    opened</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=136 data-line-end=137><a id="Get_all_attend_in_the_course_before_136"></a>Get
        all attend in the course before</h3>
    <ul>
        <li class="has-line-data" data-line-start="137" data-line-end="138">Method : GET.</li>
        <li class="has-line-data" data-line-start="138" data-line-end="139">URL : /api/courses/{course_id}/attend</li>
        <li class="has-line-data" data-line-start="139" data-line-end="143">Rules :
            <ul>
                <li class="has-line-data" data-line-start="140" data-line-end="141">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="141" data-line-end="143">User must already be registered in
                    the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=143 data-line-end=144><a id="Get_attend_status_143"></a>Get attend status</h3>
    <ul>
        <li class="has-line-data" data-line-start="144" data-line-end="145">Method : GET.</li>
        <li class="has-line-data" data-line-start="145" data-line-end="146">URL : /api/courses/{course_id}/attend/status
        </li>
        <li class="has-line-data" data-line-start="146" data-line-end="150">Rules :
            <ul>
                <li class="has-line-data" data-line-start="147" data-line-end="148">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="148" data-line-end="150">User must already be registered in
                    the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=150 data-line-end=151><a id="Get_all_the_users_who_have_attended_150"></a>Get
        all the users who have attended</h3>
    <ul>
        <li class="has-line-data" data-line-start="151" data-line-end="152">Method : GET.</li>
        <li class="has-line-data" data-line-start="152" data-line-end="153">URL : /api/courses/{course_id}/attend/users
        </li>
        <li class="has-line-data" data-line-start="153" data-line-end="157">Rules :
            <ul>
                <li class="has-line-data" data-line-start="154" data-line-end="155">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="155" data-line-end="156">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="156" data-line-end="157">Must be a teacher.</li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=159 data-line-end=160><a id="Material_159"></a>Material</h2>
    <h3 class="code-line" data-line-start=160 data-line-end=161><a id="Get_all_materials_from_the_course_160"></a>Get
        all materials from the course</h3>
    <ul>
        <li class="has-line-data" data-line-start="161" data-line-end="162">Method : GET.</li>
        <li class="has-line-data" data-line-start="162" data-line-end="163">URL : /api/courses/{course_id}/materials
        </li>
        <li class="has-line-data" data-line-start="163" data-line-end="167">Rules :
            <ul>
                <li class="has-line-data" data-line-start="164" data-line-end="165">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="165" data-line-end="167">User must already be registered in
                    the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=167 data-line-end=168><a
            id="Create_a_material_in_the_given_course_167"></a>Create a material in the given course</h3>
    <ul>
        <li class="has-line-data" data-line-start="168" data-line-end="169">Method : POST.</li>
        <li class="has-line-data" data-line-start="169" data-line-end="170">URL : /api/courses/{course_id}/materials
        </li>
        <li class="has-line-data" data-line-start="170" data-line-end="175">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 100 character.</td>
                    </tr>
                    <tr>
                        <td>description</td>
                        <td>Optional</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="175" data-line-end="180">Rules :
            <ul>
                <li class="has-line-data" data-line-start="176" data-line-end="177">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="177" data-line-end="178">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="178" data-line-end="180">Must be a teacher.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=180 data-line-end=181><a id="Get_a_material_180"></a>Get a material</h3>
    <ul>
        <li class="has-line-data" data-line-start="181" data-line-end="182">Method : GET.</li>
        <li class="has-line-data" data-line-start="182" data-line-end="183">URL :
            /api/courses/{course_id}/materials/{material_id}</li>
        <li class="has-line-data" data-line-start="183" data-line-end="188">Rules :
            <ul>
                <li class="has-line-data" data-line-start="184" data-line-end="185">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="185" data-line-end="186">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="186" data-line-end="188">Material must in the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=188 data-line-end=189><a id="Update_a_material_188"></a>Update a material</h3>
    <ul>
        <li class="has-line-data" data-line-start="189" data-line-end="190">Method : PUT.</li>
        <li class="has-line-data" data-line-start="190" data-line-end="191">URL :
            /api/courses/{course_id}/materials/{material_id}</li>
        <li class="has-line-data" data-line-start="191" data-line-end="196">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 100 character.</td>
                    </tr>
                    <tr>
                        <td>description</td>
                        <td>Optional</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="196" data-line-end="203">Rules :
            <ul>
                <li class="has-line-data" data-line-start="197" data-line-end="198">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="198" data-line-end="199">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="199" data-line-end="200">Material must in the course.</li>
                <li class="has-line-data" data-line-start="200" data-line-end="201">Must be a teacher.</li>
                <li class="has-line-data" data-line-start="201" data-line-end="203">Must be the course owner.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=203 data-line-end=204><a id="Delete_a_material_203"></a>Delete a material</h3>
    <ul>
        <li class="has-line-data" data-line-start="204" data-line-end="205">Method : DELETE.</li>
        <li class="has-line-data" data-line-start="205" data-line-end="206">URL :
            /api/courses/{course_id}/materials/{material_id}</li>
        <li class="has-line-data" data-line-start="206" data-line-end="213">Rules :
            <ul>
                <li class="has-line-data" data-line-start="207" data-line-end="208">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="208" data-line-end="209">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="209" data-line-end="210">Material must in the course.</li>
                <li class="has-line-data" data-line-start="210" data-line-end="211">Must be a teacher.</li>
                <li class="has-line-data" data-line-start="211" data-line-end="213">Must be the course owner.</li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=213 data-line-end=214><a id="Shareable_File_213"></a>Shareable File</h2>
    <h3 class="code-line" data-line-start=214 data-line-end=215><a id="Get_all_shareable_file_214"></a>Get all shareable
        file</h3>
    <ul>
        <li class="has-line-data" data-line-start="215" data-line-end="216">Method : GET.</li>
        <li class="has-line-data" data-line-start="216" data-line-end="217">URL :
            /api/courses/{course_id}/materials/{material_id}/file</li>
        <li class="has-line-data" data-line-start="217" data-line-end="222">Rules :
            <ul>
                <li class="has-line-data" data-line-start="218" data-line-end="219">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="219" data-line-end="220">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="220" data-line-end="222">Material must in the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=222 data-line-end=223><a id="Upload_a_shareable_file_222"></a>Upload a
        shareable file</h3>
    <ul>
        <li class="has-line-data" data-line-start="223" data-line-end="224">Method : POST.</li>
        <li class="has-line-data" data-line-start="224" data-line-end="225">URL :
            /api/courses/{course_id}/materials/{material_id}/file</li>
        <li class="has-line-data" data-line-start="225" data-line-end="230">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 100 character.</td>
                    </tr>
                    <tr>
                        <td>file</td>
                        <td>Required, Value = file type, Mimes :
                            jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="230" data-line-end="236">Rules :
            <ul>
                <li class="has-line-data" data-line-start="231" data-line-end="232">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="232" data-line-end="233">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="233" data-line-end="234">Material must in the course.</li>
                <li class="has-line-data" data-line-start="234" data-line-end="236">Must be a teacher.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=236 data-line-end=237><a id="Download_the_shareable_file_236"></a>Download the
        shareable file</h3>
    <ul>
        <li class="has-line-data" data-line-start="237" data-line-end="238">Method : GET.</li>
        <li class="has-line-data" data-line-start="238" data-line-end="239">URL :
            /api/courses/{course_id}/materials/{material_id}/file/{file_id}</li>
        <li class="has-line-data" data-line-start="239" data-line-end="245">Rules :
            <ul>
                <li class="has-line-data" data-line-start="240" data-line-end="241">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="241" data-line-end="242">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="242" data-line-end="243">Material must in the course.</li>
                <li class="has-line-data" data-line-start="243" data-line-end="245">The file must be a shareable file.
                </li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=245 data-line-end=246><a id="Delete_a_shareable_file_245"></a>Delete a
        shareable file</h3>
    <ul>
        <li class="has-line-data" data-line-start="246" data-line-end="247">Method : DELETE.</li>
        <li class="has-line-data" data-line-start="247" data-line-end="248">URL :
            /api/courses/{course_id}/materials/{material_id}/file/{file_id}</li>
        <li class="has-line-data" data-line-start="248" data-line-end="255">Rules :
            <ul>
                <li class="has-line-data" data-line-start="249" data-line-end="250">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="250" data-line-end="251">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="251" data-line-end="252">Material must in the course.</li>
                <li class="has-line-data" data-line-start="252" data-line-end="253">Must be a teacher.</li>
                <li class="has-line-data" data-line-start="253" data-line-end="255">The file must be a shareable file.
                </li>
            </ul>
        </li>
    </ul>
    <h2 class="code-line" data-line-start=255 data-line-end=256><a id="Submit_File_255"></a>Submit File</h2>
    <h3 class="code-line" data-line-start=256 data-line-end=257><a id="Get_all_submited_file_256"></a>Get all submited
        file</h3>
    <ul>
        <li class="has-line-data" data-line-start="257" data-line-end="258">Method : GET.</li>
        <li class="has-line-data" data-line-start="258" data-line-end="259">URL :
            /api/courses/{course_id}/materials/{material_id}/submit</li>
        <li class="has-line-data" data-line-start="259" data-line-end="264">Rules :
            <ul>
                <li class="has-line-data" data-line-start="260" data-line-end="261">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="261" data-line-end="262">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="262" data-line-end="264">Material must in the course.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=264 data-line-end=265><a id="Upload_a_submit_file_264"></a>Upload a submit
        file</h3>
    <ul>
        <li class="has-line-data" data-line-start="265" data-line-end="266">Method : POST.</li>
        <li class="has-line-data" data-line-start="266" data-line-end="267">URL :
            /api/courses/{course_id}/materials/{material_id}/submit</li>
        <li class="has-line-data" data-line-start="267" data-line-end="272">Request :
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Rules</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>name</td>
                        <td>Required, MAX = 100 character.</td>
                    </tr>
                    <tr>
                        <td>file</td>
                        <td>Required, Value = file type, Mimes :
                            jpeg,png,jpg,bmp,gif,svg,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li class="has-line-data" data-line-start="272" data-line-end="278">Rules :
            <ul>
                <li class="has-line-data" data-line-start="273" data-line-end="274">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="274" data-line-end="275">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="275" data-line-end="276">Material must in the course.</li>
                <li class="has-line-data" data-line-start="276" data-line-end="278">Must be a student.</li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=278 data-line-end=279><a id="Download_the_submited_file_278"></a>Download the
        submited file</h3>
    <ul>
        <li class="has-line-data" data-line-start="279" data-line-end="280">Method : GET.</li>
        <li class="has-line-data" data-line-start="280" data-line-end="281">URL :
            /api/courses/{course_id}/materials/{material_id}/submit/{file_id}</li>
        <li class="has-line-data" data-line-start="281" data-line-end="287">Rules :
            <ul>
                <li class="has-line-data" data-line-start="282" data-line-end="283">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="283" data-line-end="284">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="284" data-line-end="285">Material must in the course.</li>
                <li class="has-line-data" data-line-start="285" data-line-end="287">The file must be a submited file.
                </li>
            </ul>
        </li>
    </ul>
    <h3 class="code-line" data-line-start=287 data-line-end=288><a id="Delete_a_submit_file_287"></a>Delete a submit
        file</h3>
    <ul>
        <li class="has-line-data" data-line-start="288" data-line-end="289">Method : DELETE.</li>
        <li class="has-line-data" data-line-start="289" data-line-end="290">URL :
            /api/courses/{course_id}/materials/{material_id}/submit/{file_id}</li>
        <li class="has-line-data" data-line-start="290" data-line-end="296">Rules :
            <ul>
                <li class="has-line-data" data-line-start="291" data-line-end="292">Must Authenticated.</li>
                <li class="has-line-data" data-line-start="292" data-line-end="293">User must already be registered in
                    the course.</li>
                <li class="has-line-data" data-line-start="293" data-line-end="294">Material must in the course.</li>
                <li class="has-line-data" data-line-start="294" data-line-end="295">Must be a teacher or the file owner.
                </li>
                <li class="has-line-data" data-line-start="295" data-line-end="296">The file must be a submited file.
                </li>
            </ul>
        </li>
    </ul>
</body>

</html>