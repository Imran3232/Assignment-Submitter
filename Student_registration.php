<html>

      <head>
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
	             <title> Assignment Submitter</title>
	  </head>
                  
			<body>
			</br></br></br></br></br>
			<form method="post" action="Student_registration.php">
			<table align ="center" width="500" height='500' bgcolor='green' border ="5">
			<tr>
			      <b> <th colspan="10"><font color='yellow'> Student's Registration Form</font></th></b>
			</tr>
			<tr>
			       <td align="right"><b><font color='yellow'>Student's Name:</font></b></td>
				   <td><input type="text" name="user_name">
                                        <font color="yellow"><b><?php echo @$_GET['name'];?></b></font></td>
			</tr>
			
			
			<tr>
			       <td align="right"><b><font color='yellow'>University/College:</font></b></td>
				   <td><input type="text" name="user_college">
                                       <font color="yellow" ><b><?php echo @$_GET['college'];?></b></font></td>
			</tr>
			
			<tr>
			       <td align="right"><b><font color='yellow'>Department:</font></b></td>
				   <td><input type="text" name="user_department">
                                       <font color="yellow" ><b><?php echo @$_GET['department'];?></b></font></td>
			</tr>
			
			<tr>
			       <td align="right"><b><font color='yellow'>Session:</font></b></td>
				   <td><input type="text" name="user_session">
                                       <font color="yellow" ><b><?php echo @$_GET['session'];?></b></font></td>
			</tr>
			
			<tr>
			       <td align="right"><b><font color='yellow'>Gender:</font></b></td>
				   <td>
				   <select name="user_gender">
				   <option value="null">Select Gender</option>
				   <option value="Male">Male</option>
				   <option value="Female">Female</option>
                                   </select>
                                       <font color="yellow" ><b><?php echo @$_GET['gender'];?></b></font>
				   </td>
			</tr>
			
			<tr>
			     <td align="right"><b><font color='yellow'>Email:</font></b></td>
			     <td><input type="text" name="user_email">
                                 <font color="yellow" ><b><?php echo @$_GET['email'];?></b></font></td>
			</tr>
			
			<tr>
			       <td align="right"><b><font color='yellow'>Password:</font></b></td>
				   <td><input type="password" name="user_password">
                                       <font color="yellow" ><b><?php echo @$_GET['password'];?></b></font></td>
			</tr>
			
			<tr>
			    <td align ="center"colspan="10">
				<input type="submit" class="button" name="submit" value="Submit">
				</td>
			</tr>
            			
			</table>
			
			</form>
			
			
<?php
include 'Registration_class.php';
if(isset($_POST['submit']))
{
 $student_name = $_POST['user_name'];
 $student_college = $_POST['user_college'];
 $student_department = $_POST['user_department'];
 $student_session = $_POST['user_session'];
 $student_gender = $_POST['user_gender'];
 $student_email = $_POST['user_email'];
 $student_password = $_POST['user_password'];
 $studentFormBuilder=new StudentFormBuilder($student_name,$student_email,$student_password);
 $studentForm=$studentFormBuilder->setCollege($student_college)->setDepartment($student_department)->setGender($student_gender)->setSession($student_session)->getStudentForm();
 $registration=new StudentRegestration($studentForm);
 if($registration->user_input_check()){
    $registration->registration(); 
 }
 
}

?>
</body>

</html>