<?php 
include("header.php");
include("connection.php");

$select = "SELECT * FROM `brand`";
$row = mysqli_query($conn, $select);

?>
     <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              

<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">VIEW ALL BRANDS</h4>
                  
                    <div class="table-responsive">
                      <table class="table text-light">
                        <thead>
                          <tr>
                            <th class="text-light">Brand id</th>
                            <th class="text-light">Brand Name</th>
                            <th class="text-light">Edit</th>
                            <th class="text-light">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                while ($data = mysqli_fetch_assoc($row)){
                                    ?>
                                    <tr>
                                        <th scope="row"> <?php echo $data['brand_id']; ?> </th>
                                        <td> <?php echo $data['brand_name']?></td>
                                        <td> <a href="viewBrand.php?i=<?php echo $data['brand_id']?>" class="btn btn-primary">Edit</a> </td>
                                        <td> <a href="viewBrand.php?j=<?php echo $data['brand_id']?>" class="btn btn-danger" onclick="return confirm('are you sure!')">Delete</a> </td>
                                    </tr>

                               <?php }?>   
                          
                        </tbody>
                      </table>
                    </div>
                 
                  
            <!-- Table End -->


            
          <!-- UPDATE AND DELETE BRANDS -->
<?php
            if(isset($_GET['i'])){
                $b_id = $_GET['i'];
                $select = "SELECT * FROM `brand` WHERE `brand_id` = '$b_id'";
                $row = mysqli_query($conn, $select);

                $data = mysqli_fetch_assoc($row);
?>    
    
        <div class="row">
        <div class="col-md-8 grid-margin stretch-card"> 
         <div class="card">
          <div class="card-body">
            <h4 class="card-title pb-3">EDIT BRAND</h4>
            <form class="forms-sample" method='POST'>
              <div class="form-group">
                <label for="exampleInputUsername1">Brand Name:</label>
                <input type="text" value="<?php echo $data['brand_name'] ?>" class="form-control" id="exampleInputUsername1" name="brand_name" placeholder="Enter brand name here...">
              </div>
              
              <button type="submit" class="btn btn-primary mr-2" name="update_btn">Update</button>
            </form>

          </div>
        </div>
      </div>
    </div>
 
    </div>
                </div>
              </div>
              <?php 
                if(isset($_POST['update_btn'])){
                    $b_name = $_POST['brand_name'];
                    $updated = "UPDATE `brand` SET `brand_name` = '$b_name' WHERE `brand_id` = '$b_id'";
                   $done = mysqli_query($conn, $updated);

                   
                    if($done){
                        echo "<script>
                        alert('Record Updated!');
                        window.location.href = 'viewBrand.php';
                        </script>";
                       }
                   
                }

           }
            ?>

<!-- DELETE  -->
<?php
if(isset($_GET['j'])){
                $b_id = $_GET['j'];
                $delete = "DELETE FROM `brand` WHERE `brand_id` = '$b_id'";
                $done = mysqli_query($conn, $delete);

                if($done){
                    echo "<script>
                    alert('Record Deleted!');
                    window.location.href = 'viewBrand.php';
                    </script>";
                   }
               
            }

                ?>

<?php 
include("footer.php");
?>