<?php
    require_once("new.php");
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
    <h2>Create Bicycle</h2>
    <form method="POST">
        <div>
            <label>Brand</label>
            <input type="text" name="brand">
        </div>
        <div>
            <label>Model</label>
            <input type="text" name="model">
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
            <option></option>
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
            <input type="text" name="color">
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
            <input type="text" name="weight_kg">
        </div>
    
    <div>
            <label>Price</label>
            $<input type="text" name="price">
        </div>

        
        <div>
            <label>Description</label>
            <textarea name="describe">

            </textarea>
        </div>

        
        <div>
            <input type="submit" value="Create Bicycle" name="submitNewBicycle">
        </div>
        </form>

    </div>
</body>
</html>