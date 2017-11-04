<html>

    <head>
        <title> Assignment Submitter</title>
        <style>
            .button {
                background-color:#4CAF50;
                border: none;
                color: yellow;
                padding: 7px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                margin: 2px 1px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        </br></br></br></br></br>
        <form method="post" action="Teacher_registration.php">
            <table align ="center" width="500" height='500' bgcolor='green' border ="5">


                <tr>
                <b> <th colspan="10"><font color='yellow'>Teacher's Registration Form</font></th></b>
                </tr>
                <tr>
                    <td align="right"><b><font color='yellow'>Name:</font></b></td>
                    <td><input type="text" name="user_name">
                        <font color="yellow"><b><?php echo @$_GET['name']; ?></b></font>
                    </td>
                </tr>


                <tr>
                    <td align="right"><b><font color='yellow'>University/College:</font></b></td>
                    <td><input type="text" name="user_college">
                        <font color="yellow"><b><?php echo @$_GET['college']; ?></b></font>
                    </td>
                </tr>

                <tr>
                    <td align="right"><b><font color='yellow'>Department:</font></b></td>
                    <td><input type="text" name="user_department">
                        <font color="yellow"><b><?php echo @$_GET['department']; ?></b></font>
                    </td>
                </tr>

                <tr>
                    <td align="right"><b><font color='yellow'>Course ID:</font></b></td>
                    <td><input type="text" name="user_course_id">
                        <font color="yellow"><b><?php echo @$_GET['course_id']; ?></b></font>
                    </td>
                </tr>

                <tr>
                    <td align="right"><b><font color='yellow'>Email:</font></b></td>
                    <td><input type="text" name="user_email"
                               <font color="yellow"><b><?php echo @$_GET['email']; ?></b></font></td>
                </tr>

                <tr>
                    <td align="right"><b><font color='yellow'>Password:</font></b></td>
                    <td><input type="password" name="user_password">
                        <font color="yellow"><b><?php echo @$_GET['password']; ?></b></font>
                    </td>
                </tr>

                <tr>
                    <td align ="center"colspan="10"><input type="submit" class="button" name="submit" value="Submit">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        include 'Registration_class.php';
        if (isset($_POST['submit'])) {
            $teacher_name = $_POST['user_name'];
            $teacher_college = $_POST['user_college'];
            $teacher_department = $_POST['user_department'];
            $teacher_course_id = $_POST['user_course_id'];
            $teacher_email = $_POST['user_email'];
            $teacher_password = $_POST['user_password'];
            $teacherFormBuilder=new TeacherFormBuilder($teacher_name,$teacher_email, $teacher_password);
            $teacherForm=$teacherFormBuilder->setCollege($teacher_college)->setCourseId($teacher_course_id)->setDepartment($teacher_department)->getTeacherForm();
            $registration = new TeacherRegistration($teacherForm);
            if ($registration->user_input_check()) {
                $registration->registration();
            }
        }
        ?>
    </body>

</html>