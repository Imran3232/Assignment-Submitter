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
    <center><h2><font color="red" ><b><?php echo @$_GET['as_id']; ?></b></font></h2></center>
    <form action='first_login.php' method='post'>
        <input type="hidden" id="hidden-id" name="student_id" value="<?php echo @$_GET['massage1']; ?>">
        <table width='450' border='2' align='center' bgcolor='green'>
            <tr>
                <td align='center' colspan='4' bgcolor='green'><h2><font color="yellow">Enter Your AS ID</font></h2>
                </td>
            </tr>
            <tr>
                <td align='center' colspan='4'><input type='text' name='teacher_id'>
                </td>
            </tr>


            <tr>
                <td colspan='4' align='center'><input type='submit' class="button" name='submit' value='Submit'>

                </td>
            </tr>

        </table>

    </form>
    <?php
    include 'ConnectionClass.php';
    if (isset($_POST['submit'])) {

        $teacher_id = $_POST['teacher_id'];
        $student_id = $_POST['student_id'];
        if ($teacher_id == '') {
            echo
            "<script>window.open('first_login.php?massage1=$student_id&as_id=AS ID is Required','_self')</script>";
            exit();
        }
        echo $teacher_id;
        echo $student_id;
        $dataBase=new DataBase("localhost","root","","project");
        $dataBase->doConnect();
        $que = "select * from teacher where t_id='$teacher_id'";
        $dataBase->doQuery($que);
        if (mysqli_num_rows($dataBase->result)>0) {
            $que2 = "update student set t_id='$teacher_id' where s_id='$student_id'";
            $dataBase->doQuery($que2);
            if($dataBase->result)
            {
                echo 
                "<script>window.open('student_page.php?massage1=$student_id&massage2=$teacher_id ','_self')</script>";
            }
        } else {
            echo
            "<script>window.open('first_login.php?massage1=$student_id&as_id=Invalid AS ID!! Collect From Your Teacher. ','_self')</script>";
            exit();
        }
    }
    ?>
</body>
</html>

