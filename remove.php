<?php
session_start();
include 'ConnectionClass.php';
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
}
else
{
    $studentId=$_GET['del'];
    $query="UPDATE `student` SET `t_id` = NULL WHERE `student`.`s_id` = $studentId";
    $dataBase = new DataBase("localhost", "root", "", "project");
    $dataBase->doConnect();
    $dataBase->doQuery($query);
    header('Location: student_list.php');
}
?>

