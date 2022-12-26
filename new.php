<!-- this is the place to create the bicycle -->

<?php

// we first check if it is clicked using this isset($_POST['submitNewBicycle']) this - submitNewBicycle is gotten from the form button
//here -  <input type="submit" value="Create Bicycle" name="submitNewBicycle">
//$_POST['brand'] , the brand inside the post [] , is gotten from the form also   --  <input type="text" name="brand">
//we use it to get the value entered inside the input value
// then we set an empty array of $args = [];
// which will be using as the variable to pass each value as an associative array which has property and value [property=>value]
//so the $args['brand'] ,$args['model'] below here are the property, while the $_POST['brand'], $_POST['model'] e.t.c are the values
// then we will instantiate, so that we can pass this our varaiable $args , i mean this one here -- $args = [];
// as the argument to the instantiation, so that it can pass the $args values to the __construct($args = []) parameter which is this $args = []
//inside the class in the bicycle.class.php
// then we used the instatiation variable which is $bicycle to return a function called create()
// which we have to go back to the class Bicycle inside the bicycle.class.php to write create() function



require_once("private/connection.php");



    if (isset($_POST['submitNewBicycle'])) {
        $args = [];
       $args['brand'] = $_POST['brand'] ?? null;
       $args['model'] =  $_POST['model'] ?? null;
       $args['year'] =  $_POST['year'] ?? null;
       $args['category'] =  $_POST['category'] ?? null;
       $args['color'] =  $_POST['color'] ?? null;
       $args['description'] =  $_POST['describe'] ?? null;
       $args['gender'] =  $_POST['gender'] ?? null;
        $args['price'] =  $_POST['price'] ?? null;
       $args['weight_kg'] =  $_POST['weight_kg'] ?? null;
       $args['condition_id'] =  $_POST['condition_id'] ?? null;

       $bicycle = new Bicycle($args);
       $result = $bicycle->save();

       // let's check if this result is true
       //then we redirect to the the page that displays all the detail.php to display the newly created data
       //using         header('Location:detail.php?id= ' .$new_id);
       //which the new_id , is holding the id of the newly created data and we are using it in navigating to the detail.php page
       //to get that exact data displayed


       if ($result === true) {
        $new_id = $bicycle->id;
        $_SESSION['message'] = "The message was saved successfully";
        header('Location:detail.php?id= ' .$new_id);

       }
    }

?>