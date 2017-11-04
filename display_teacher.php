<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: Welcome_page.php');
}
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <title>Download Files</title>
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
        <a href='teacher_page.php'><font color='green' size='4'>Homepage</font></a>&emsp;
        <a href='logout.php'><font color='red' size='4'>Logout</font></a>
        <br>
    <center>
        <div class="container home">
            <font face="comic sans ms">
            <h3><center> List of Files Uploaded By You </center> </h3>
            </font>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><font face="comic sans ms">Subject</font></th>
                        <th><font face="comic sans ms">Topic </font></th>
                        <th><font face="comic sans ms">Download Files </font></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'FileHandlerClass.php';
                    $dataBase = new DataBase("localhost", "root", "", "project");
                    $folder;
                    $dataBase->doConnect();
                    $teacher_id = $_SESSION['user_id'];
                    $query1 = "select count(*) \"total\" from file_teacher where id='$teacher_id'";
                    $dataBase->doQuery($query1);
                    $row = (mysqli_fetch_array($dataBase->result));
                    $total = $row['total'];
                    $dis = 5;
                    $total_page = ceil($total / $dis);
                    $page_cur = (isset($_GET['page'])) ? $_GET['page'] : 1;
                    $k = ($page_cur - 1) * $dis;
                    $query2 = "select * from teacher where t_id='$teacher_id'";
                    $dataBase->doQuery($query2);
                    while ($row = mysqli_fetch_array($dataBase->result)) {
                        $folder = $row['t_folder'];
                    }
                    $_SESSION['folder'] = $folder;
                    $query3 = "select * from file_teacher order by t_f_id DESC limit $k,$dis";
                    $dataBase->doQuery($query3);
                    while ($row = mysqli_fetch_array($dataBase->result)) {
                        echo '<tr>';
                        echo '<td align=center>' . $row['subject'];
                        echo '<td align=center>' . $row['topic'];
                        echo "<td align=center><a title='Click here to download in file.' 
		     href='download.php?id={$row['file']}'>{$row['file']} </a>";
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</tbody>';
                    echo '<br/>';
                    if ($page_cur > 1) {
                        echo '<a href="display_teacher.php?page=' . ($page_cur - 1) . '" style="cursor:pointer;color:DeepSkyBlue ;" ><input style="cursor:pointer;background-color:DeepSkyBlue;border:1px black solid;border-radius:5px;width:120px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Previous "></a> ';
                    } else {

                        echo '<input style="background-color:DeepSkyBlue;border:1px black solid;border-radius:5px;width:120px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value=" Previous "> ';
                    }
                    for ($i = 1; $i < $total_page; $i++) {
                        if ($page_cur == $i) {

                            echo '<input style="background-color:DeepSkyBlue ;border:2px black solid;border-radius:5px;width:30px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="' . $i . '"> ';
                        } else {
                            echo '<a href="display_teacher.php?page=' . $i . '"> <input style="cursor:pointer;background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:30px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value="' . $i . '"> </a> ';
                        }
                    }
                    if ($page_cur < $total_page) {

                        echo '<a href="display_teacher.php?page=' . ($page_cur + 1) . '"><input style="cursor:pointer;background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:90px;height:30px;color:white;font-size:15px;font-weight:bold;" type="button" value=" Next "></a>';
                    } else {

                        echo '<input style="background-color:DeepSkyBlue ;border:1px black solid;border-radius:5px;width:90px;height:30px;color:black;font-size:15px;font-weight:bold;" type="button" value="   Next "> ';
                    }
                    ?>
                    </div>
                    </center>
                    </body>
                    </html>								
