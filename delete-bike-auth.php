<?php
  require_once("private/connection.php");

        if (isset($_POST['deleteCommit'])) {

            $theHiddenId = $_POST['hiddenId'];

            $bicycle = Bicycle::find_by_id($theHiddenId);

         

            $result = $bicycle->delete();
         
            if ($result) {
                header("Location:index.php");
            }
          }
?>