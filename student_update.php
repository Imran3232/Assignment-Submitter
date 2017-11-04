<?php
include 'update_implementation.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
} else {
    $student_id = $_SESSION['user_id'];
    $studentUpdate = new StudentAcount($student_id);
    $studentUpdate->gatherData();
}
?>
<html>

    <head>
          <title>Update Account</title>
          
      <style type="text/css">
            .button {
                background-color:#4CAF50;
                border: none;
                color: yellow;
                padding: 7px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
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
        <a href='student_page.php'><font color='green'size='4'>Homepage</font></a>&emsp;
        <a href='logout.php'><font color='red'size='4'>Logout</font></a>
        <form method="post" action="student_update.php">
            <center><b> <font color='green' size='4'><?php echo @$_GET['massage']; ?>
                    <table align ="center" width="500" height='500' bgcolor='green' border ="5">
                        <tr>
                        <b> <th colspan="10"><font color='yellow'> Student's Registration Form</font></th></b>
                        </tr>
                        <tr>
                            <td align="right"><b><font color='yellow'>Student's Name:</font></b></td>
                            <td><input type="text" name="user_name"  value="<?php echo $studentUpdate->student_name_old; ?>">
                                <font color="yellow"><b><?php echo @$_GET['name']; ?></b></font></td>
                        </tr>


                        <tr>
                            <td align="right"><b><font color='yellow'>University/College:</font></b></td>
                            <td><input type="text" name="user_college"  value="<?php echo $studentUpdate->student_college_old; ?>">
                                <font color="yellow" ><b><?php echo @$_GET['college']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Department:</font></b></td>
                            <td><input type="text" name="user_department"  value="<?php echo $studentUpdate->student_department_old; ?>">
                                <font color="yellow" ><b><?php echo @$_GET['department']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Session:</font></b></td>
                            <td><input type="text" name="user_session"  value="<?php echo $studentUpdate->student_session_old; ?>">
                                <font color="yellow" ><b><?php echo @$_GET['session']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Gender:</font></b></td>
                            <td>
                                <select name="user_gender">
                                    <option value="null">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <font color="yellow" ><b><?php echo @$_GET['gender']; ?></b></font>
                            </td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Email:</font></b></td>
                            <td><input type="text" name="user_email"  value="<?php echo $studentUpdate->student_email_old; ?>">
                                <font color="yellow" ><b><?php echo @$_GET['email']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align="right"><b><font color='yellow'>Password:</font></b></td>
                            <td><input type="password" name="user_password"  value="<?php echo $studentUpdate->student_password_old; ?>">
                                <font color="yellow" ><b><?php echo @$_GET['password']; ?></b></font></td>
                        </tr>

                        <tr>
                            <td align ="center"colspan="10">
                                <input type="submit" class="button" name="update" value="Update">
                            </td>
                        </tr>

                    </table>

                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $student_name = $_POST['user_name'];
                        $student_college = $_POST['user_college'];
                        $student_department = $_POST['user_department'];
                        $student_session = $_POST['user_session'];
                        $student_gender = $_POST['user_gender'];
                        $student_email = $_POST['user_email'];
                        $student_password = $_POST['user_password'];
                        $studentUpdate->studentNewdata($student_name, $student_college, $student_department, $student_session, $student_email, $student_password, $student_gender);
                        $studentUpdate->updateData();
                    }
                    ?>
                    </body>

                    </html>