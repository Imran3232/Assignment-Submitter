<html>
    <head>
        <title>Sign Up</title>
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

        <form action='signup.php' method='post'>

            <table width='400' border='2' align='center' bgcolor='green'>
                <tr>
                    <td align='center' colspan='4' bgcolor='green'><h2><font color="yellow">Sign Up Form</font></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan='4' align='center'><input type='submit' class="button" name='sign_up_student' value='Sign Up As A Student'>
                    </td>
                </tr>
                <tr>
                    <td colspan='4' align='center'><input type='submit' class="button" name='sign_up_teacher' value='Sign Up As A Teacher'>
                    </td>
                </tr>

            </table>

        </form>

    </body>
</html>
<?php
if (isset($_POST['sign_up_teacher'])) {
    header('Location: Teacher_registration.php');
} else if (isset($_POST['sign_up_student'])) {
    header('Location: Student_registration.php');
}
?>
     