<?php

interface PersonBuilder {

    public function setDepartment($department);

    public function setCollege($college);
}

class StudentForm {

    var $student_name, $student_college;
    var $student_department, $student_session;
    var $student_gender, $student_email, $student_folder;
    var $student_password, $student_id;

    public function __construct($StudentName, $studentCollege, $StudentDepartment, $StudentSession, $StudentGender, $StudentEmail, $StudentPassword) {
        $this->student_name = $StudentName;
        $this->student_college = $studentCollege;
        $this->student_department = $StudentDepartment;
        $this->student_session = $StudentSession;
        $this->student_gender = $StudentGender;
        $this->student_email = $StudentEmail;
        $this->student_password = $StudentPassword;
    }

}

class TeacherForm {

    var $teacher_name, $teacher_college;
    var $teacher_department, $teacher_course_id;
    var $teacher_email, $teacher_id;
    var $teacher_password, $teacher_folder;

    public function __construct($TeacherName, $TeacherCollege, $TeacherDepartment, $TeacherCourseId, $TeacherEmail, $TeacherPassword) {
        $this->teacher_name = $TeacherName;
        $this->teacher_college = $TeacherCollege;
        $this->teacher_department = $TeacherDepartment;
        $this->teacher_course_id = $TeacherCourseId;
        $this->teacher_email = $TeacherEmail;
        $this->teacher_password = $TeacherPassword;
    }

}

class StudentFormBuilder implements PersonBuilder {

    var $student_name, $student_college;
    var $student_department, $student_session;
    var $student_gender, $student_email, $student_folder;
    var $student_password, $student_id;

    public function __construct($sudent_name, $student_email, $student_password) {
        $this->student_name = $sudent_name;
        $this->student_email = $student_email;
        $this->student_password = $student_password;
    }

    public function setCollege($college) {
        $this->student_college = $college;
        return $this;
    }

    public function setDepartment($department) {
        $this->student_department = $department;
        return $this;
    }

    public function setSession($Session) {
        $this->student_session = $Session;
        return $this;
    }

    public function setGender($Gender) {
        $this->student_gender = $Gender;
        return $this;
    }

    public function getStudentForm() {
        return new StudentForm($this->student_name, $this->student_college, $this->student_department, $this->student_session, $this->student_gender, $this->student_email, $this->student_password);
    }

}
class TeacherFormBuilder implements PersonBuilder
{
    var $teacher_name, $teacher_college;
    var $teacher_department, $teacher_course_id;
    var $teacher_email, $teacher_id;
    var $teacher_password, $teacher_folder;
    public function __construct($teacher_name, $teacher_email, $teacher_password) {
        $this->teacher_name = $teacher_name;
        $this->teacher_email = $teacher_email;
        $this->teacher_password = $teacher_password;
    }
    public function setCollege($college) {
        $this->teacher_college=$college;
        return $this;
    }

    public function setDepartment($department) {
        $this->teacher_department=$department;
        return $this;
    }
    public function setCourseId($CourseId)
    {
        $this->teacher_course_id=$CourseId;
        return $this;
    }
    public function getTeacherForm()
    {
        return new TeacherForm($this->teacher_name, $this->teacher_college, $this->teacher_department, $this->teacher_course_id, $this->teacher_email, $this->teacher_password);
    }

}
?>

