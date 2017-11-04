<?php
session_start();
?>
<html>
    <head>
        <title>Login</title>
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
    <center><h3><font color="red" ><b><?php echo @$_GET['massage']; ?></b></font></h3></center>
    <form action='login.php' method='post'>

        <table width='450' border='2' align='center' bgcolor='green'>
            <tr>
                <td align='center' colspan='4' bgcolor='green'><h2><font color="yellow">Login Form</font></h2>
                </td>
            </tr>
            <tr>
                <td align='right'><b><font color="yellow">Email:</font></b></td>
                <td><input type='text' name='email'>
                    <font color="yellow" ><b><?php echo @$_GET['email']; ?></b></font>
                </td>
            </tr>
            <tr>
                <td align='right'><b><font color="yellow">Password:</font></b></td>
                <td><input type='password' name='password'>
                    <font color="yellow" ><b><?php echo @$_GET['password']; ?></b></font></td>
            </tr>
            <tr>
                <td colspan='4' align='center'><input type='submit' class="button" name='submit' value='Submit'>
                </td>
            </tr>

        </table>

    </form>
    <?php
    include 'login_class.php';
    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $s_login = new Student_login($email, $password);
        $t_login = new Teacher_login($email, $password);
        if ($s_login->user_input_check() && $t_login->user_input_check()) {
            if ($s_login->login()) {
                $_SESSION['user_id'] = $s_login->student_id;
                $_SESSION['user_name'] = $s_login->student_name;
                if ($s_login->teacher_id == '') {
                    echo
                    "<script>window.open('first_login.php?massage1=$s_login->student_id&massage2=$s_login->student_name','_self')</script>";
                    exit();
                } else {
                    echo
                    "<script>window.open('student_page.php?massage1=$s_login->student_id&massage2=$s_login->student_name','_self')</script>";
                    exit();
                }
            } else if ($t_login->login()) {
                $_SESSION['user_id'] = $t_login->teacher_id;
                $_SESSION['user_name'] = $t_login->teacher_name;
                echo
                "<script>window.open('teacher_page.php?massage1=$t_login->teacher_id&massage2=$t_login->teacher_name','_self')</script>";
            } else {
                echo
                "<script>window.open('login.php?massage=Email Or Password Is Invalid','_self')</script>";
                exit();
            }
        }
    }
    ?>
</body>
</html>

