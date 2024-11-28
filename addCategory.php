<?php 
include("header.php");
include("connection.php");
?>

            
<div class="main-panel">
  <div class="content-wrapper">
    
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card"> <!-- Adjust width to col-md-8 or col-md-12 -->
        <div class="card">
          <div class="card-body">
            <h4 class="card-title pb-3">ADD CATEGORY</h4>
            <form class="forms-sample" method="POST">
              <div class="form-group">
                <label for="exampleInputUsername1">Category Name:</label>
                <input type="text" class="form-control text-light" id="exampleInputUsername1" placeholder="Enter category name here..." name="category_name">
              </div>
              
              <button type="submit" class="btn btn-primary mr-2" name="category_btn">Add</button>
              <button class="btn btn-dark">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ADD CATEGORY PHP -->
         
            <?php

            if(isset($_POST['category_btn'])){
                $c_name = $_POST['category_name'];

                $insert = "INSERT INTO `category` (category_name)
                VALUES ('$c_name')";

               $done =  mysqli_query($conn, $insert);

               if($done){
                echo "<script>
                alert('Record Inserted!');
                window.location.href = 'viewCategory.php';
                </script>";
               }
            }
            ?>

            <?php 
include("footer.php");
?>