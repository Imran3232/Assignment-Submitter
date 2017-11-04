<html>


    <head>

        <title>Assignment Submitter</title>
        <style>
            .button {
                background-color:#4CAF50;
                border: none;
                color: black;
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
        <form  action="Welcome_page.php" method="post">
            <table align="right">
                <tr>
                    <td align="right"> <input type="submit" class="button" name="login" value="Login">
                        <input type="submit" class="button" name="signup" value="Sign Up"></td>
                <center><b> <font color='green' size='4'><?php echo @$_GET['massage']; ?>
                        </font></b></center>
                </tr>
            </table>

            <h1>
                <b>
                    <font color ="blue">
                    <center>&emsp;&emsp;&emsp;&emsp; Welcome to Assignment Submitter<br><br></center>
                    </font>

                    <center> The incredibly easy, completely free Q&A platform<br>
                        Save time and help students learn using the power of community<br></center>
                    <img align ="right" height="300" width="300" vspace = "90" hspace ="100" src="welcome.jpg"/>
                </b>
            </h1>
        </form>
        <form  action="Welcome_page.php" method="post">
            </br></br>
            <ul>
                <li><h2><font color="gray">Questions and posts needing immediate action are highlighted </font></h2>
                <li><h2><font color="gray">Instructors endorse answers to keep the class on track </font></h2>
                <li><h2><font color="gray">Anonymous posting encourages every student to participate </font></h2>
                <li><h2><font color="gray">Highly customizable online polls </font></h2>
                <li><h2><font color="gray">Integrates with every major LMS </font></h2>
            </ul>
            </br></br></br>&emsp;
            <input type="submit" class="button" name="sign_up_teacher" value="Sign Up As A Teacher">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <input type="submit" class="button" name="sign_up_student" value="Sign Up As A Student">
        </form>

    </body>


</html>

<?php
if (isset($_POST['sign_up_teacher'])) {
    header('Location: Teacher_registration.php');
} else if (isset($_POST['sign_up_student'])) {
    header('Location: Student_registration.php');
}
else if (isset($_POST['login'])) {
    header('Location: login.php');
}
else if (isset($_POST['signup'])) {
    header('Location: signup.php');
}
?>