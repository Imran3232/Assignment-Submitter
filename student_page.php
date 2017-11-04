<?php
include 'FileHandlerClass.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
} else {
    $dataBase = new DataBase("localhost", "root", "", "project");
    $dataBase->doConnect();
    $student_id = $_SESSION['user_id'];
    $query = "select * from student where s_id='$student_id'";
    $dataBase->doQuery($query);
    while ($row = mysqli_fetch_array($dataBase->result)) {
        $_SESSION['teacher_id'] = $row['t_id'];
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link href= 'style.css' rel= 'stylesheet'>
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

                font-size:12;
                font-weight:bold;
            }


        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Student Page</title>
    </head>
    <body>
        <ul>
            <li> <a><?php echo $_SESSION['user_name'] ?></a> </li>
            <li> <a> About </a>
                <ul>
                    <li><a> Our team</a></li>
                    <li> <a> Mission</a></li>
                </ul>
            </li>
            <li> <a href='display_student.php'> View Own File </a> </li>
            <li> <a href='view_teacher_file.php'> View Teacher File </a> </li>
            <li> <a> Settings</a> 
                <ul>
                    <li><a href='student_update.php'> Account</a></li>
                    <li> <a href='logout.php'>Logout</a></li>
                </ul>
            </li>
        </ul>
        <br><br><br><br><br><br><br><br><br><br>

        <div class="container home">
            <br>
            <form id="form3" enctype="multipart/form-data" method="post" action="student_page.php">
                <input type="hidden" id="hidden-id" name="student_id" value="<?php echo @$_GET['massage1']; ?>">
                <table class="table table-bordered" align="center">         	
                    <tr>
                        <td>	<label for="sub">Subject: </label>	</td>
                        <td>	<input type="text" name="subject" id="sub" class="input-medium"  
                                    required autofocus placeholder="Title of the subject"/>	</td>
                    </tr>
                    <tr>
                        <td valign="top" align="left">Topic:</td>
                        <td valign="top" align="left"><input type="text" name="topic" cols="50" rows="10" id="pre"  
                                                             placeholder="Name of the topic"
                                                             class="input-medium" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="file">File:</label></td>
                        <td><input type="file" name="file" id="file" 
                                   title="Click here to select file to upload." required /></td>
                    </tr>
                    <tr>

                        <td colspan="2" align="center">		    
                            <input type="submit" class="btn btn-primary" name="upload" id="upload" 
                                   title="Click here to upload the file." value="Upload File" /> </td>

                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<?php
if (isset($_POST['upload'])) {
    $name = $_FILES['file']['name'];
    $student_id = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $topic = $_POST['topic'];
    $fileUploader = UploadHandler::getInistance($student_id, $subject, $topic, $name);
    if ($fileUploader->uploadFile("student")) {
        if (file_exists($fileUploader->folderName . $_FILES["file"]["name"])) {
            echo '<script language="javascript">alert(" Sorry!! Filename Already Exists...")</script>';
        } else {
            if ($fileUploader->ManageUpload()) {
                move_uploaded_file($_FILES["file"]["tmp_name"], $fileUploader->folderName . $_FILES["file"]["name"]);
               $_SESSION['teacher_id']=null;
               $_SESSION['student_id']=$_SESSION['user_id'];
               header("location:ChainOfResponsibilityClass.php");
            } else {
                echo '<script language="javascript">alert("Failed To Uplod")</script>';
            }
        }
    }
}
?>


