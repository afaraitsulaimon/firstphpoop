<?php 

// Autoload class definitions

// this is needed so that all classes can be gotten
//this simply means include('classes/' . $class . '.class.php');
//Go to classes folder , check class name which is passed then concatenate it with class.php

function my_autoload($class) {
  if(preg_match('/\A\w+\Z/', $class)) {
    include('classes/' . $class . '.class.php');
  }
}
spl_autoload_register('my_autoload');



      DEFINE("DBSERVER","localhost");
      DEFINE("DBUSER","root");
      DEFINE("DBNAME","practicephp");
      DEFINE("DBPASS","");
    

      $connection = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);


      if ($connection->connect_errno) {
        $msg = "Database connection failed";
        $msg .= $connection->connect_error;
        $msg .= "(" . $connection->connect_errno .")";

        exit($msg);
      }


      // we call the function/method that set the database from the class Bicycle
      //and pass in the $connection as an argument
      //so with this..the Bicycle class knows about the database connection
      
      Bicycle::set_database($connection);

?>