<?php 
include("header.php");
include("connection.php");

$select = "SELECT * FROM `category`";
$row = mysqli_query($conn, $select);

?>
     <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              

<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">VIEW ALL CATEGORIES</h4>
                  
                    <div class="table-responsive">
                      <table class="table text-light">
                        <thead>
                          <tr>
                            <th class="text-light">Category id</th>
                            <th class="text-light">Catgeory Name</th>
                            <th class="text-light">Edit</th>
                            <th class="text-light">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                while ($data = mysqli_fetch_assoc($row)){
                                    ?>
                                    <tr>
                                        <th scope="row"> <?php echo $data['category_id']; ?> </th>
                                        <td> <?php echo $data['category_name']?></td>
                                        <td> <a href="viewCategory.php?i=<?php echo $data['category_id']?>" class="btn btn-primary">Edit</a> </td>
                                        <td> <a href="viewCategory.php?j=<?php echo $data['category_id']?>" class="btn btn-danger">Delete</a> </td>
                                    </tr>

                               <?php }?>
                          
                        </tbody>
                      </table>
                    </div>
                 
                  
            <!-- Table End -->


<?php

// UPDATED 
if(isset($_GET['i'])){
    $c_id = $_GET['i'];
    $select = "SELECT * FROM `category` WHERE `category_id` = '$c_id'";
    $row = mysqli_query($conn, $select);

    $data = mysqli_fetch_assoc($row);
?>

       
    
        <div class="row">
        <div class="col-md-8 grid-margin stretch-card"> 
         <div class="card">
          <div class="card-body">
            <h4 class="card-title pb-3">EDIT CATEGORY</h4>
            <form class="forms-sample" method='POST'>
              <div class="form-group">
                <label for="exampleInputUsername1">Category Name:</label>
                <input type="text" value="<?php echo $data['category_name'] ?>" class="form-control" id="exampleInputUsername1" name="category_name" placeholder="Enter category name here...">
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
                    $c_name = $_POST['category_name'];
                    $updated = "UPDATE `category` SET `category_name` = '$c_name' WHERE `category_id` = '$c_id'";
                   $done = mysqli_query($conn, $updated);

                   
                    if($done){
                        echo "<script>
                        alert('Record Updated!');
                        window.location.href = 'viewCategory.php';
                        </script>";
                       }
                   
                }

           }
            ?>
<!-- DELETE  -->
<?php
if(isset($_GET['j'])){
                $c_id = $_GET['j'];
                $delete = "DELETE FROM `category` WHERE `category_id` = '$c_id'";
                $done = mysqli_query($conn, $delete);

                if($done){
                    echo "<script>
                    alert('Record Deleted!');
                    window.location.href = 'viewCategory.php';
                    </script>";
                   }
               
            }

                ?>
<?php 
include("footer.php");
?>