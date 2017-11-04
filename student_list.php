<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
} else {
    $teacher_id = $_SESSION['user_id'];
}
?>
<html>


    <head>

        <title> Viewing Student Record</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <style type="text/css">
            #wrapper {
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

                font-size:14;
                font-weight:bold;
            }
        </style>
    </head>



    <body></br>
        <a href='teacher_page.php'><font color='green'size='4'>Homepage</font></a>&emsp;
        <a href='logout.php'><font color='red'size='4'>Logout</font></a>
    <center><font color='red' size='4'><?php echo @$_GET['deleted']; ?>
<?php echo @$_GET['updated']; ?>
        </font></center>
    <table align="center" width="1000" border="4">
        <tr>
            <td colspan="20" align="center" bgcolor="green">
                <h1><font color='yellow'>Viewing All The Student Records</font></h1></td>
        </tr>
        <tr align='center'>
            <th><font color='green'>Serial No</font></th>
            <th><font color='green'>Student's Name</font></th>
            <th><font color='green'>Department</font></th>
            <th><font color='green'>Session</font></th>
            <th><font color='green'>Delete</font></th>
            <th><font color='green'>View File</font></th>

        </tr>
<?php
include 'ConnectionClass.php';
$dataBase = new DataBase("localhost", "root", "", "project");
$dataBase->doConnect();
$que = "select * from student where t_id='$teacher_id' order by 1 DESC";
$dataBase->doQuery($que);
$i = 1;
while ($row = mysqli_fetch_array($dataBase->result)) {
    $s_id = $row['s_id'];
    $s_name = $row['s_name'];
    $s_department = $row['s_department'];
    $s_session = $row['s_session'];
    ?>
            <tr align='center'>
                <td><?php echo $i;
        $i++ ?></td>
                <td><?php echo $s_name; ?></td>
                <td><?php echo $s_department; ?></td>
                <td><?php echo $s_session; ?></td>
                <td><a href='remove.php?del=<?php echo $s_id; ?>'>Delete</a></td>
                <td><a href ='view_student_file.php?file=<?php echo $_SESSION['student_id'] = $s_id;
        $_SESSION['student_name'] = $s_name; ?>'>View File</a></td>			
            </tr>
        <?php } ?>
    </table>

</body>


</html>

