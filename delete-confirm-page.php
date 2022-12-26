

<?php
require_once("private/connection.php");
require_once("delete-bike-auth.php");



// we are first looking at it , if it get the id
// the if it is true, we stored it inside the variable
    if (!isset($_GET['id'])) {
      header("Location:index.php");

    }

    //get the id of the clicked one
    // then we need to get the data of the id that we got from the url
    $idToDelete = $_GET['id'];

    $bicycle = Bicycle::find_by_id($idToDelete);


?>
<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="bicycle delete">
    <h1>Delete Bicycle</h1>
    <p>Are you sure you want to delete this bicycle?</p>
    <p class="item"><?php echo $bicycle->name(); ?></p>

    <form  method="post">
      <div id="operations">
      <input type="text" name="hiddenId" value="<?php echo $bicycle->id ?>" hidden />

        <input type="submit" name="deleteCommit" value="Delete Bicycle"  />
      </div>
    </form>
  </div>

</div>

