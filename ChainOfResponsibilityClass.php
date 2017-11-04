<?php

include 'ConnectionClass.php';

interface EmailHandler {

    public function setNext($nextEmailHandler);

    public function process($studentId, $teacherId, $userName);
}

class TeacherEmailHandler implements EmailHandler {

    var $dataBase;
    private $myHandler = null;

    public function __construct() {
        $this->dataBase = new DataBase("localhost", "root", "", "project");
        $this->dataBase->doConnect();
    }

    public function process($studentId, $teacherId, $userName) {
        if ($teacherId == null) {
            if ($this->myHandler == null) {
                exit();
            } else {
                $this->myHandler->process($studentId, $teacherId, $userName);
            }
        } else {
            $query = "select * from student where t_id='$teacherId'";
            $this->dataBase->doQuery($query);
            $userName = strtoupper($userName);
            while ($row = mysqli_fetch_array($this->dataBase->result)) {
                $studentEmail = $row['s_email'];
                $massage = "Your Teacher " . $userName . " send you a new file.See Your teacher file list";
                $subject = "New file from your teacher.";
                mail($studentEmail, $subject, $massage, 'from: Assignment Submitter');
            }
            echo '<script language="javascript">alert("File Uploded")</script>';
            header("Refresh: 0; url=teacher_page.php");
        }
    }

    public function setNext($nextEmailHandler) {
        $this->myHandler = $nextEmailHandler;
    }

}

class StudentEmailHandler implements EmailHandler {

    var $dataBase;
    private $myHandler = null;

    public function __construct() {
        $this->dataBase = new DataBase("localhost", "root", "", "project");
        $this->dataBase->doConnect();
    }

    public function process($studentId, $teacherId, $userName) {
        if ($studentId == null) {
            if ($this->myHandler == null) {
                exit();
            } else {
                $this->myHandler->process($studentId, $teacherId, $userName);
            }
        } else {
            $query = "select * from student where s_id='$studentId'";
            $this->dataBase->doQuery($query);
            $userName = strtoupper($userName);
            while($row = mysqli_fetch_array($this->dataBase->result))
            {
                $teacherId=$row['t_id'];
            }
            $query1 = "select * from teacher where t_id='$teacherId'";
            $this->dataBase->doQuery($query1);
            while ($row1 = mysqli_fetch_array($this->dataBase->result)) {
                $teacherEmail = $row1['t_email'];
                $massage = "Your student " . $userName . " send you a new file.See Your student list";
                $subject = "New file from your student.";
                mail($teacherEmail, $subject, $massage, "From Assignment Submitter");
            }
            echo '<script language="javascript">alert("File Uploded")</script>';
            header("Refresh: 0; url=student_page.php");
        }
    }

    public function setNext($nextEmailHandler) {
        $this->myHandler = $nextEmailHandler;
    }

}


?>
<?php
session_start();
$teacherEmailHandler = new TeacherEmailHandler();
$studentEmailHandler = new StudentEmailHandler();
$teacherEmailHandler->setNext($studentEmailHandler);
$teacherEmailHandler->process($_SESSION['student_id'], $_SESSION['teacher_id'],$_SESSION['user_name']);
?>


