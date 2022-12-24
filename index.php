
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
        <th>&nbsp</th>

    </tr>
    <?php

        // $result = $connection->query($sql);
//so instead of doing this  $result = $connection->query($sql);  
//we know need to require our connection.php in this file again 
//since our Bicycle class has already knows our database connection and we have a property for it,
//we can now call it like this on the query
//Bicycle::$database->query($sql) , which the $database if from the class of Bicycle, i mean this  static public $database;

//instead of calling this tow line below inside here
//$sql = "SELECT * FROM bicycles";
//$result = Bicycle::$database->query($sql);

//let go and call it inside our Bicycle class using a method that will be find_all() -- this function can be anything
//we just decided to call it find alls
//so this result         $result = Bicycle::$database->query($sql);
// will be change to         $result = Bicycle::find_all(); -- which find_all() is a static function that comes from the Bicycle class



// we will also remove this now 2
//  $row = $result->fetch_assoc();
//$result->free();
//and take it to the Bicycle class inside the method find_by_sql

        // $result = Bicycle::find_all();
      

        // echo "BRAND: " .$row['brand'];
        // echo "<br/>";
        
        // echo "MODEL: " .$row['model'];
        // echo "<br/>";

        // echo "YEAR: " .$row['year'];

        $bikes =  Bicycle::find_all();
        
    ?>
    
    <?php  foreach ($bikes as $bike) { ?>
        <tr>
            <td><?php echo $bike['brand']; ?></td>
            <td><?php echo $bike['model'] ?></td>
            <td><?php echo $bike['year'] ?></td>
            <td><?php echo $bike['category'] ?></td>
            <td><?php echo $bike['color'] ?></td>
            <td><?php echo $bike['description'] ?></td>
            <td><?php echo $bike['gender'] ?></td>
            <td><?php echo $bike['price'] ?></td>
            <td><?php echo $bike['weight_kg'] ?></td>
            <td><?php echo $bike['condition_id'] ?></td>
            <td><a href="detail.php?id=<?php echo $bike['id'] ?>">View</a></td>


        </tr>
    <?php } ?>

    </table>
</body>
</html>