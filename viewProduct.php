<?php 
include("header.php");
include("connection.php");


$select = "SELECT p.product_id, p.product_name, p.product_price, p.product_type, p.product_description, p.product_image, c.category_name, b.brand_name 
FROM `product` p
INNER JOIN `category` c
ON p.category_id = c.category_id
INNER JOIN `brand` b
ON p.brand_id = b.brand_id";

$row = mysqli_query($conn, $select);

?>
<style>
.table td, .table th {
    white-space: normal; 
    min-width:70px;
}

.table-responsive {
    overflow-x: auto; 
}

.table {
    table-layout: auto; 
    word-wrap: break-word;
}

.table img {
    width: 75px !important;
    height: 75px !important;
    border-radius: 0 !important;
}

</style>
              <!-- TABLE START -->

<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">VIEW PRODUCTS</h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <div>
                      <table class="table text-light table-responsive">
                        <thead>
                          <tr>
                            <th class="text-light" scope="col">Product Id</th>
                            <th class="text-light" scope="col">Product Name</th>
                            <th class="text-light" scope="col">Product Price</th>
                            <th class="text-light" scope="col">Product Type</th>
                            <th class="text-light" scope="col">Product Description</th>
                            <th class="text-light" scope="col">Product Image</th>
                            <th class="text-light" scope="col">Category Name</th>
                            <th class="text-light" scope="col">Brand Name</th>
                            <th class="text-light" scope="col">Edit</th>
                            <th class="text-light" scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                while ($data = mysqli_fetch_assoc($row)){
                                    ?>
                                    <tr>
                                        <td scope="row"> <?php echo $data['product_id']; ?> </td>
                                        <td> <?php echo $data['product_name']?></td>
                                        <td> <?php echo $data['product_price']?></td>
                                        <td> <?php echo $data['product_type']?></td>
                                        <td> <?php echo $data['product_description']?></td>
                                        <td> <img src="product_images/<?php echo $data['product_image']?> " alt="error" width="300px"height="300px"></td>
                                        <td> <?php echo $data['category_name']?></td>
                                        <td> <?php echo $data['brand_name']?></td>
                                        <td> <a href="editProduct.php?i=<?php echo $data['product_id']?>" class="btn btn-primary">Edit</a> </td>
                                        <td> <a href="?j=<?php echo $data['product_id']?>" class="btn btn-danger" >Delete</a> </td>
                                    </tr>

                               <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          
<!-- DELETE RECORD PHP CODE -->
 <?php

if(isset($_GET['j'])){
                $p_id = $_GET['j'];
                $delete = "DELETE FROM `product` WHERE `product_id` = '$p_id'";
                $done = mysqli_query($conn, $delete);

                if($done){
                    echo "<script>
                    alert('Record Deleted!');
                    window.location.href = 'viewProduct.php';
                    </script>";
                   }
               
            }

                ?>
<?php 
include("footer.php");
?>