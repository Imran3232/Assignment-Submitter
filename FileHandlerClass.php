<?php

include 'ConnectionClass.php';

class UploadHandler {

    private static $fileHandler = null;
    private $unique_id, $dataBase, $subject, $topic, $name, $boolean, $type;
    var $folderName;

    private function __construct($unique_id, $subject, $topic, $name) {
        $this->dataBase = new DataBase("localhost", "root", "", "project");
        $this->dataBase->doConnect();
        $this->subject = $subject;
        $this->topic = $topic;
        $this->name = $name;
        $this->unique_id = $unique_id;
    }

    public static function getInistance($unique_id, $subject, $topic, $name) {
        if (self::$fileHandler == null) {
            self::$fileHandler = new UploadHandler($unique_id, $subject, $topic, $name);
        }
        return self::$fileHandler;
    }

    public function ManageUpload() {
        $table = "file_" . $this->type;
        
        $query = "insert into $table(id,subject,topic,file) values ('$this->unique_id','$this->subject','$this->topic','$this->name')";
        $this->dataBase->doQuery($query);
        if ($this->dataBase->result) {
            $this->boolean = true;
        } else {
            $this->boolean = false;
        }
        return $this->boolean;
    }

    public function uploadFile($type) {
        $this->type = $type;
        if ($type == "student") {
            $query = "select * from student where s_id='$this->unique_id'";
            $this->dataBase->doQuery($query);
            while ($row = mysqli_fetch_array($this->dataBase->result)) {
                $this->folderName = $row['s_folder'];
            }
            $this->boolean = true;
        } else if ($type == "teacher") {
            $query = "select * from teacher where t_id='$this->unique_id'";
            $this->dataBase->doQuery($query);
            while ($row = mysqli_fetch_array($this->dataBase->result)) {
                $this->folderName = $row['t_folder'];
            }
            $this->boolean = true;
        } else {
            $this->boolean = false;
        }
        return $this->boolean;
    }

}

class DownloadHandler {

    private static $fileHandler = null;
    var $folderName, $fileName;

    private function __construct($folderName, $fileName) {
        $this->folderName = $folderName;
        $this->fileName = $fileName;
    }

    public static function getInistance($folderName, $fileName) {
        if (self::$fileHandler == null) {
            self::$fileHandler = new DownloadHandler($folderName, $fileName);
        }
        return self::$fileHandler;
    }

    public function DownloadFile() {
        $file = './' . $this->folderName . $this->fileName;
        $title = $this->fileName;
        header("Pragma: public");
        header('Content-disposition: attachment; filename=' . $title);
        header('Content-Transfer-Encoding: binary');
        ob_clean();
        flush();
        $chunksize = 1 * (1024 * 1024);
        if (filesize($file) > $chunksize) {
            $handle = fopen($file, 'rb');
            $buffer = '';
            while (!feof($handle)) {
                $buffer = fread($handle, $chunksize);
                echo $buffer;
                ob_flush();
                flush();
            }
            fclose($handle);
        } else {
            readfile($file);
        }
    }

}

?>
