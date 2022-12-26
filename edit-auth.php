<?php
require_once("private/connection.php");

// WE FIRST CHECK IF IT DOES NOW HAVE THE ID, SO THAT WHEN IT DOES NOT HAVE THE ID,!isset($_GET['id'])
//WE REDIRECT TO BACK TO THE INDEX.PHP PAGE
//but if it does, then get the id and store it in a variable and then check if the button to update  is clicked
    if (!isset($_GET['id'])) {
        header("Location:index.php");
    }

    // this is the id we got from the url when we click to redirect here
    $idOfContent = $_GET['id'];
    $bicycle = Bicycle::find_by_id($idOfContent);
// if ($bicycle == false) {
//     header("Location:index.php");
// } 

    // let's check if the button is click to update the item
    //which is coming from the submit button of the eit-data.php
    // <input type="submit" value="Edit Bicycle" name="submitEditedBicycle">


    if (isset($_POST['submitEditedBicycle'])) {
        
        // we set an empty array, which we will se all the data gotten inside it like this
        //$args =['brand'=>'valueComingFromTheInputOfbrand', 'model'=>'valueComingFromTheInputOfModel',]
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

        // we will merge attributes with our $args
        //which will make the args have the form data
        //so that we can update , we will write a function called merge_attributes and it takes parameter of $args
        // the args passed here , is from here $args = []; we will be writing it inside the bicycle.class.php , which is the Bicycle class

        $bicycle->merge_attributes($args);

        // then we will update
        //which we still have to write the function also
       $result = $bicycle->save();


       $result = false;

       // let's check if this result is true
       //then we redirect to the the page that displays all the detail.php to display the newly created data
       //using         header('Location:detail.php?id= ' .$idOfContent);
       //which the idOfContent , is holding the id of the content we want to update we are using it in navigating to the detail.php page
       //to get that exact data displayed


       if ($result === true) {
        $_SESSION['message'] = "The Bicycle was Updated successfully";
        header('Location:detail.php?id= ' .$idOfContent);

       }else {
        # code... show errors
       }
    }
?>