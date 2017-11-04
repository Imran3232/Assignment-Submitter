<?php
require_once 'ConnectionClass.php';

abstract class Login {

    abstract public function user_input_check();

    abstract public function login();
}

class Student_login extends Login {

    var $student_name, $student_college;
    var $student_department, $student_session;
    var $student_gender, $student_email;
    var $student_password, $student_id, $teacher_id;

    public function __construct($e, $p) {
        $this->student_email = $e;
        $this->student_password = $p;
    }

    public function login() {
        $que = "select * from student where s_email='$this->student_email' and s_password='$this->student_password'";
        $dataBase = new DataBase("localhost", "root", "", "project");
        $dataBase->doConnect();
        $dataBase->doQuery($que);
        if (mysqli_num_rows($dataBase->result) > 0) {
            while ($row = mysqli_fetch_array($dataBase->result)) {
                $this->student_id = $row['s_id'];
                $this->teacher_id = $row['t_id'];
                $this->student_name = $row['s_name'];
                $this->student_college = $row['s_college'];
                $this->student_gender = $row['s_gender'];
                $this->student_session = $row['s_session'];
                $this->student_department = $row['s_department'];
            }
            return true;
        } else {
            return false;
        }
    }

    public function user_input_check() {
        if ($this->student_email == '') {
            echo
            "<script>window.open('login.php?email=Email is Required','_self')</script>";
            exit();
        }
        if ($this->student_password == '') {
            echo
            "<script>window.open('login.php?password=Password is Required','_self')</script>";
            exit();
        }
        return true;
    }

}

class Teacher_login extends Login {

    var $teacher_name, $teacher_college;
    var $teacher_department, $teacher_course_id;
    var $teacher_email, $teacher_id;
    var $teacher_password;

    public function __construct($e, $p) {
        $this->teacher_email = $e;
        $this->teacher_password = $p;
    }

    public function login() {
        $que = "select * from teacher where t_email='$this->teacher_email' and t_password='$this->teacher_password'";
        $dataBase = new DataBase("localhost", "root", "", "project");
        $dataBase->doConnect();
        $dataBase->doQuery($que);
        if (mysqli_num_rows($dataBase->result) > 0) {
            while ($row = mysqli_fetch_array($dataBase->result)) {
                $this->teacher_id = $row['t_id'];
                $this->teacher_name = $row['t_name'];
                $this->teacher_college = $row['t_college'];
                $this->teacher_department = $row['t_department'];
                $this->teacher_course_id = $row['t_course_id'];
            }
            return true;
        } else {
            return false;
        }
    }

    public function user_input_check() {
        if ($this->teacher_email == '') {
            echo
            "<script>window.open('login.php?email=Email is Required','_self')</script>";
            exit();
        }
        if ($this->teacher_password == '') {
            echo
            "<script>window.open('login.php?password=Password is Required','_self')</script>";
            exit();
        }
        return true;
    }

}

?>