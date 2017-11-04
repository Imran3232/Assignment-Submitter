

<?php

include 'connection.php';

abstract class UpdateAcount {

    abstract public function gatherData();

    abstract public function userInputCheck();

    abstract public function updateData();
}

class StudentAcount extends UpdateAcount {

    var $student_name, $student_college;
    var $student_department, $student_session;
    var $student_gender, $student_email;
    var $student_password, $student_id, $teacher_id;
    var $student_name_old, $student_college_old;
    var $student_department_old, $student_session_old;
    var $student_gender_old, $student_email_old;
    var $student_password_old, $student_id_old;

    public function __construct($id) {
        $this->student_id = $id;
    }

    public function gatherData() {
        $que = "select * from student where s_id='$this->student_id'";
        $conn = OpenCon();
        $run = mysqli_query($conn, $que);
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $this->student_name_old = $row['s_name'];
                $this->student_college_old = $row['s_college'];
                $this->student_gender_old = $row['s_gender'];
                $this->student_session_old = $row['s_session'];
                $this->student_department_old = $row['s_department'];
                $this->student_email_old = $row['s_email'];
                $this->student_password_old = $row['s_password'];
            }
        }
    }

    public function studentNewdata($s_name, $s_college, $s_department, $s_session, $s_email, $s_password, $s_gender) {

        $this->student_name = $s_name;
        $this->student_college = $s_college;
        $this->student_gender = $s_gender;
        $this->student_session = $s_session;
        $this->student_department = $s_department;
        $this->student_email = $s_email;
        $this->student_password = $s_password;
    }

    public function userInputCheck() {
        if ($this->student_name == '') {
            $this->student_name = $this->student_name_old;
        }
        if ($this->student_college == '') {
            $this->student_college = $this->student_college_old;
        }
        if ($this->student_gender == 'null') {
            $this->student_gender = $this->student_gender_old;
        }
        if ($this->student_session == '') {
            $this->student_session = $this->student_session_old;
        }
        if ($this->student_department == '') {
            $this->student_department = $this->student_department_old;
        }
        if ($this->student_email == '') {
            $this->student_email = $this->student_email_old;
        }
        if ($this->student_password == '') {
            $this->student_password = $this->student_password_old;
        }
    }

    public function updateData() {
        $Con = OpenCon();
        $query = "UPDATE student SET    
	s_name = '$this->student_name',s_college='$this->student_college',
	s_gender='$this->student_gender',s_session='$this->student_session',s_department='$this->student_department',
        s_email='$this->student_email' , s_password='$this->student_password' where s_id='$this->student_id'";
        if (mysqli_query($Con, $query)) {
            echo "<script>window.open('student_update.php?massage=Successfully updated!!','_self')</script>";
        }
    }

}

class TeacherAcount extends UpdateAcount {

    var $teacher_name_old, $teacher_college_old;
    var $teacher_department_old, $teacher_course_id_old;
    var $teacher_email_old, $teacher_id_old, $teacher_id2_old;
    var $teacher_password_old;
    var $teacher_name, $teacher_college;
    var $teacher_department, $teacher_course_id;
    var $teacher_email, $teacher_id, $teacher_id2;
    var $teacher_password;

    public function __construct($id) {
        $this->teacher_id_old = $id;
    }

    public function gatherData() {
        $que = "select * from teacher where t_id='$this->teacher_id_old' ";
        $conn = OpenCon();
        $run = mysqli_query($conn, $que);
        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $this->teacher_id=$row['t_id'];
                $this->teacher_name_old = $row['t_name'];
                $this->teacher_college_old = $row['t_college'];
                $this->teacher_department_old = $row['t_department'];
                $this->teacher_course_id_old = $row['t_course_id'];
                $this->teacher_email_old = $row['t_email'];
                $this->teacher_password_old = $row['t_password'];
            }
        }
    }

    function teacherNewdata($t_name, $t_college, $t_department, $t_course_id, $t_email, $t_password) {
        $this->teacher_name = $t_name;
        $this->teacher_college = $t_college;
        $this->teacher_department = $t_department;
        $this->teacher_course_id = $t_course_id;
        $this->teacher_email = $t_email;
        $this->teacher_password = $t_password;
    }

    public function userInputCheck() {
        if ($this->teacher_name == '') {
            $this->teacher_name = $this->teacher_name_old;
        }
        if ($this->teacher_college == '') {
            $this->teacher_college = $this->teacher_college_old;
        }
        if ($this->teacher_department == '') {
            $this->teacher_department = $this->teacher_department_old;
        }
        if ($this->teacher_course_id == '') {
            $this->teacher_course_id = $this->teacher_course_id_old;
        }
        if ($this->teacher_email == '') {
            $this->teacher_email = $this->teacher_email_old;
        }
        if ($this->teacher_password == '') {
            $this->teacher_password = $this->teacher_password_old;
        }
    }

    public function updateData() {
        $this->userInputCheck();
        $con = OpenCon();
        $query = "UPDATE teacher SET 
          t_name='$this->teacher_name',t_college='$this->teacher_college',   
          t_department='$this->teacher_department',t_email = '$this->teacher_email',
          t_course_id = '$this->teacher_course_id',t_password='$this->teacher_password' where t_id='$this->teacher_id_old'";
        if (mysqli_query($con, $query)) {
            echo "<script>window.open('teacher_update.php?massage=Successfully updated!!','_self')</script>";
        }
    }
}
?>
