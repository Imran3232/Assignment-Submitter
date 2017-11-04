
<?php
include 'update_implementation.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
} else {
    $teacher_id = $_SESSION['user_id'];
    $t = new TeacherAcount($teacher_id);
    $s = $t->gatherData();
}
?>
<html>

    <head>
        <title> Update Account</title>
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
            .#wrapper {
                margin: 0 auto;
                float: none;
                width:70%;
            }
            .header {
                padding:10px 0;
                border-bottom:1px solid #CCC;
            }
            .title {
                padding: 0 5px 0 0;
                float:left;
                margin:0;
            }
            .container form input {
                height: 30px;
            }
            body
            {

                font-size:12;
                font-weight:bold;
            }
        </style>

    </head>

    <body>
        <a href='teacher_page.php'><font color='green'size='4'>Homepage</font></a>&emsp;
        <a href='logout.php'><font color='red'size='4'>Logout</font></a>
        <form method="post" action="teacher_update.php">
            <center><b> <font color='green' size='4'><?php echo @$_GET['massage']; ?>
                    <table align ="center" width="500" height='500' bgcolor='green' border ="5">


                        <tr>
                        <b> <th colspan="10"><font color='yellow'>Teacher Update</font></th></b>
                        </tr>
                        <tr>
                            <td align="right"><b><font color='yellow'>ID:</font></b></td>
                            <td><input type="text" name="user_name" value="<?php echo $t->teacher_id; ?>">
                                <font color="yellow"><b><?php echo @$_GET['name']; ?></b></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><b><font color='yellow'>Name:</font></b></td>
                            <td><input type="text" name="user_name" value="<?php echo $t->teacher_name_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['name']; ?></b></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><b><font color='yellow'>University/College:</font></b></td>
                            <td><input type="text" name="user_college" value="<?php echo $t->teacher_college_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['college']; ?></b></font>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Department:</font></b></td>
                            <td><input type="text" name="user_department" value="<?php echo $t->teacher_department_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['department']; ?></b></font>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Course ID:</font></b></td>
                            <td><input type="text" name="user_course_id" value="<?php echo $t->teacher_course_id_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['course_id']; ?></b></font>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Email:</font></b></td>
                            <td><input type="text" name="user_email" value="<?php echo $t->teacher_email_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['email']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Password:</font></b></td>
                            <td><input type="password" name="user_password"value="<?php echo $t->teacher_password_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['password']; ?></b></font>
                            </td>
                        </tr>

                        <tr>
                            <td align ="center"colspan="10"><input type="submit" class="button" name="update" value="Update">
                            </td>
                        </tr>

                    </table>

                    </form>

                    <?php
                    if (isset($_POST['update'])) {

                        $teacher_name = $_POST['user_name'];
                        $teacher_college = $_POST['user_college'];
                        $teacher_department = $_POST['user_department'];
                        $teacher_course_id = $_POST['user_course_id'];
                        $teacher_email = $_POST['user_email'];
                        $teacher_password = $_POST['user_password'];
                        $t->teacherNewdata($teacher_name, $teacher_college, $teacher_department, $teacher_course_id, $teacher_email, $teacher_password);
                        $t->updateData();
                    }
                    ?>
                    </body>

                    </html>
