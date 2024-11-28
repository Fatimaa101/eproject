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
            <h4 class="card-title pb-3">ADD BRANDS</h4>
            <form class="forms-sample" method="POST">
              <div class="form-group">
                <label for="exampleInputUsername1">Brand Name:</label>
                <input type="text" class="form-control text-light" id="exampleInputUsername1" placeholder="Enter brand name here..." name="brand_name">
              </div>
              
              <button type="submit" class="btn btn-primary mr-2" name="brand_btn">Add</button>
              <button class="btn btn-dark">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

         <!-- ADD BRAND PHP -->
 <?php

 if(isset($_POST['brand_btn'])){
     $b_name = $_POST['brand_name'];

     $insert = "INSERT INTO `brand` (brand_name)
     VALUES ('$b_name')";

    $done =  mysqli_query($conn, $insert);

    if($done){
     echo "<script>
     alert('Record Inserted!');
     window.location.href = 'viewBrand.php';
     </script>";
    }
 }
 ?>

            <?php 
include("footer.php");
?>