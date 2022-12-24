

<?php 
    require_once("private/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table class="table table-stripped table-border">
    <tr>
    <th>brand</th>

    <th>model</th>
        <th>year</th>
        <th>category</th>
        <th>color</th>
        <th>description</th>
        <th>gender</th>
        <th>price</th>
        <th>weight_kg</th>
        <th>condition_id</th>
        <th>&nbsp;</th>
    </tr>
    <?php

        //let's get the id from the url first $_GET['Id'] the id here is the one from here
        //  href="detail.php?id=<?php echo $bike['id'] , from where you click it
        // this one here href="detail.php?id
        // so we need to check it, if it get the id using tenary operator
        $id = $_GET['id'] ?? false;

        if (!$id) {
           location:'index.php';
        }

        // then let's us use the function find_by_id, that we have inside the class Bicycle

        $bike = Bicycle::find_by_id($id);




        
    ?>
    
   
        <tr>
            <td><?php echo $bike->brand; ?></td>
            <td><?php echo $bike->model ?></td>
            <td><?php echo $bike->year ?></td>
            <td><?php echo $bike->category ?></td>
            <td><?php echo $bike->color ?></td>
            <td><?php echo $bike->description ?></td>
            <td><?php echo $bike->gender ?></td>
            <td><?php echo $bike->price ?></td>
            <td><?php echo $bike->weight_kg ?></td>
            <td><?php echo $bike->condition_id; ?></td>

        </tr>

    </table>
</body>
</html>