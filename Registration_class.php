<?php

include 'connection.php';
include 'builderclass.php';

abstract class Registration {

    abstract public function user_input_check();

    abstract public function checkEmail();

    abstract public function registration();
}

class StudentRegestration extends Registration {

    var $student_name, $student_college;
    var $student_department, $student_session;
    var $student_gender, $student_email, $student_folder;
    var $student_password, $student_id;

    public function __construct($studentForm) {
        $this->student_name = $studentForm->student_name;
        $this->student_college = $studentForm->student_college;
        $this->student_department = $studentForm->student_department;
        $this->student_session = $studentForm->student_session;
        $this->student_gender = $studentForm->student_gender;
        $this->student_email = $studentForm->student_email;
        $this->student_password = $studentForm->student_password;
    }
     public function checkEmail() {
        $query1="select * from student";
        $query2="select * from teacher";
    }

    public function user_input_check() {
        if ($this->student_name == '') {
            echo
            "<script>window.open('Student_registration.php?name=Name is Required','_self')</script>";
            exit();
        }
        if ($this->student_email == '') {
            echo
            "<script>window.open('Student_registration.php?email=Email is Required','_self')</script>";
            exit();
        }
        if ($this->student_password == '') {
            echo
            "<script>window.open('Student_registration.php?password=Password is Required','_self')</script>";
            exit();
        }
        return true;
    }

    public function registration() {
        $que = "insert into student(s_name,s_college,s_department,s_session,s_gender,s_email,s_password)
        values('$this->student_name','$this->student_college','$this->student_department','$this->student_session',
       '$this->student_gender','$this->student_email','$this->student_password')";
        $conn = OpenCon();
        if ($conn->query($que) == TRUE) {
            $query = "select * from student where s_email='$this->student_email' and s_password='$this->student_password'";
            $run = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($run)) {
                $this->student_id = $row['s_id'];
            }
            $this->student_folder = "student" . $this->student_id . "/";
            $update = "update student set s_folder='$this->student_folder' where s_id='$this->student_id'";
            if (mysqli_query($conn, $update)) {
                mkdir($this->student_folder);
                echo "<script>window.open('Welcome_page.php?massage=Registration complete!!','_self')</script>";
            } else {
                echo "<script>window.open('Welcome_page.php?massage=Registration failed.Try again!!','_self')</script>";
            }
        } else {
            echo "<script>window.open('Welcome_page.php?massage=Registration failed.Try again!!','_self')</script>";
        }
    }
}

class TeacherRegistration extends Registration {

    var $teacher_name, $teacher_college;
    var $teacher_department, $teacher_course_id;
    var $teacher_email, $teacher_id;
    var $teacher_password, $teacher_folder;

    public function __construct($teacherForm) {
        $this->teacher_name = $teacherForm->teacher_name;
        $this->teacher_college = $teacherForm->teacher_college;
        $this->teacher_department = $teacherForm->teacher_department;
        $this->teacher_course_id = $teacherForm->teacher_course_id;
        $this->teacher_email = $teacherForm->teacher_email;
        $this->teacher_password = $teacherForm->teacher_password;
    }
    public function checkEmail() {
        
    }
    public function user_input_check() {
        if ($this->teacher_name == '') {
            echo
            "<script>window.open('Teacher_registration.php?name=Name is Required','_self')</script>";
            exit();
        }
        if ($this->teacher_email == '') {
            echo
            "<script>window.open('Teacher_registration.php?email=Email is required','_self')</script>";
            exit();
        }
        if ($this->teacher_password == '') {
            echo
            "<script>window.open('Teacher_registration.php?password=Password is required','_self')</script>";
            exit();
        }
        return true;
    }

    public function registration() {
        $que = "insert into teacher(t_name,t_college,t_department,t_course_id,t_email,t_password)
        values('$this->teacher_name','$this->teacher_college','$this->teacher_department','$this->teacher_course_id',
       '$this->teacher_email','$this->teacher_password')";
        $conn = OpenCon();
        if ($conn->query($que) == TRUE) {
            $query = "select * from teacher where t_email='$this->teacher_email' and t_password='$this->teacher_password'";
            $run = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($run)) {
                $this->teacher_id = $row['t_id'];
            }
            $this->teacher_folder = "teacher" . $this->teacher_id . "/";
            $update = "update teacher set t_folder='$this->teacher_folder' where t_id='$this->teacher_id'";
            if (mysqli_query($conn, $update)) {
                mkdir($this->teacher_folder);
                echo "<script>window.open('Welcome_page.php?massage=Registration complete!!','_self')</script>";
            } else {
                echo "<script>window.open('Welcome_page.php?massage=Registration failed.Try again!!','_self')</script>";
            }
        } else {
            echo "<script>window.open('Welcome_page.php?massage=Registration failed.Try again!!','_self')</script>";
        }
    }

}
?>

