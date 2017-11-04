<?php

abstract class State {

    abstract public function DoSomething();
}

class DataBase {

    var $dbHost, $dbUser, $dbPass, $dbName;
    var $result,$sql;
    var $Mystate,$closeState,$connectionState,$queryState;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
       // $this->Mystate = null;
        $this->result = null;
        $this->sql=null;
        $this->closeState=new CloseState($this);
        $this->connectionState=new ConnectionState($this);
        $this->queryState=new QueryState($this);
        $this->Mystate = $this->closeState;
    }
public function doClose()
{
    $this->closeState->DoSomething();
    //$this->Mystate->DoSomething();
}
public function doConnect()
{
    $this->connectionState->DoSomething();
   // $this->Mystate->DoSomething();
}
public function doQuery($sql)
{
    $this->sql=$sql;
    $this->queryState->DoSomething();
   // $this->Mystate->DoSomething();
}

public function setState($state) {
        $this->Mystate = $state;
    }
}

class CloseState extends State {

    var $database, $result;

    public function __construct($database) {
        $this->database = $database;
        $this->result = $this->database->result;
    }

    public function DoSomething() {
        if ($this->result == null) {
            $this->database->setState($this);
            // $this->database->setState($this->database->connectionState);
        } else {
            $this->result == null;
            $this->database->result = null;
            $this->database->setState($this);
            // $this->database->setState($this->database->connectionState);
        }
    }

}

class ConnectionState extends State {

    var $database, $result;

    public function __construct($database) {
        $this->database = $database;
        $this->result = $this->database->result;
    }

    public function DoSomething() {
        if ($this->result == null) {
            $this->result = $this->database->result = new mysqli($this->database->dbHost, $this->database->dbUser, $this->database->dbPass, $this->database->dbName)or die("Connect failed: %s\n" . $this->conn->error);
            $this->database->setState($this);
            // $this->database->setState($this->database->queryState);
        } else{
            $this->database->result = new mysqli($this->database->dbHost, $this->database->dbUser, $this->database->dbPass, $this->database->dbName)or die("Connect failed: %s\n" . $this->conn->error);
           $this->database->setState($this);
            //$this->database->setState($this->database->queryState);
        }
    }

}

class QueryState extends State {

    var $database, $result;

    public function __construct($database) {
        $this->database = $database;
        $this->result = $this->database->result;
    }

    public function DoSomething() {
        if ($this->result == null) {
            $this->result = $this->database->result;
            $this->database->result = mysqli_query($this->result, $this->database->sql);
            $this->database->setState($this);
        } else {
            $this->database->result = mysqli_query($this->result, $this->database->sql);
            $this->database->setState($this);
        }
    }

}
?>

