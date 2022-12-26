<?php
    require_once("edit-auth.php");
?>

<?php
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
    <div>
    <h2>Edit Bicycle</h2>
    <form method="POST">
        <div>
            <label>Brand</label>
            <input type="text" name="brand" value="<?php echo $bicycle->brand ?>">
        </div>
        <div>
            <label>Model</label>
            <input type="text" name="model" value="<?php echo $bicycle->model ?>">
        </div>

        <div>
            <label>Year</label>
      
            <select name="year">
            <option></option>
            <option value="1995">1995</option>
            <option value="1996">1996</option>
            <option value="1997">1997</option>
            <option value="1998">1998</option>
            <option value="1999">1999</option>
            <option value="2000">2000</option>
            <option value="2001">2001</option>
            <option value="2002">2002</option>
            </select>
        </div>
       
        <div>
            <label>Category</label>
            <select name="category">
            <option value=""></option>
        
            <option value="road">Road</option>
            <option value="mountain">Mountain </option>
            <option value="hybrid"> Hybrid</option>
            <option value="cruiser">Cruiser</option>
            <option value="city">City </option>
            <option value="BMX">BMX</option>

            </select>
        </div>

        <div>
            <label>Gender</label>
            <select name="gender">
            <option></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="unisex">Unisex</option>

            </select>
        </div>

        <div>
            <label>Color</label>
            <input type="text" name="color" value="<?php echo $bicycle->color ?>">
        </div>

  
        <div>
            <label>Condition</label>
            <select name="condition_id">
            <option></option>
            <option value="bestUp">Best Up</option>
            <option value="decent">Decent</option>
            <option value="good">Good</option>
            <option value="great">Great</option>
            <option value="used">Used</option>
            <option value="new">New</option>
            </select>
        </div>

        
        <div>
            <label>Weight(kg)</label>
            <input type="text" name="weight_kg" value="<?php echo $bicycle->weight_kg ?>">
        </div>
    
    <div>
            <label>Price</label>
            $<input type="text" name="price" value="<?php echo $bicycle->price ?>">
        </div>

        
        <div>
            <label>Description</label>
            <textarea name="describe" >
            <?php echo $bicycle->description ?>
            </textarea>
        </div>

        
        <div>
            <input type="submit" value="Edit Bicycle" name="submitEditedBicycle">
        </div>
        </form>

    </div>
</body>
</html>