<?php 
include("header.php");
?>

<?php 
include("connection.php");
$c_sel = "SELECT * FROM `category`";
$c_row = mysqli_query($conn, $c_sel);

$b_sel = "SELECT * FROM `brand`";
$b_row = mysqli_query($conn, $b_sel);

?>
<style>
    .form-select {
        background-color: #343a40; 
        color: #ffffff;
        border: 1px solid #495057; 
        padding: 10px; 
        border-radius: 15px; 
    }

    .form-select:focus {
        background-color: #495057;
        color: #ffffff; 
        outline: none; 
        border:none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
    }

    .form-select option {
        background-color: #343a40; 
        color: #ffffff;
        padding: 10px; 
    }
    
</style>

        <!-- Form Start -->
        <div class="main-panel">
        <div class="content-wrapper">
            
        <div class="row">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">ADD PRODUCTS</h4>
                    <form class="forms-sample"  method="post" enctype="multipart/form-data">

                 
                        <div class="rounded p-4">
                           <label for="">Category</label>
                            <select name="c_id" class="form-select mb-5" aria-label="Default select example">
                                <option selected>Select Category</option>
                                <?php
                                while($option = mysqli_fetch_assoc($c_row)){ ?>
                                    <option value=" <?php echo $option['category_id']?> "> <?php echo $option['category_name']?> </option>
                             <?php   }
                                ?>
                                
                            </select>

                            <label for="">Brand</label>
                            <select name="b_id" class="form-select mb-5" aria-label="Default select example">
                                <option selected>Select Brand</option>

                                <?php
                                while($option = mysqli_fetch_assoc($b_row)){ ?>
                                    <option value=" <?php echo $option['brand_id']?> "> <?php echo $option['brand_name']?> </option>
                             <?php   }
                                ?>

                            </select>

                      <div class="form-group">
                        <label for="exampleInputUsername1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter product name..." name="p_name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Product Price</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter product price..." name="p_price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Type</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter product type..."  name="p_type">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Description</label>
                        <textarea class="form-control" rows="5" placeholder="Enter product desc..." id="exampleInputPassword1" name="p_desc" aria-label="Product Description"></textarea>

                      </div>
                     
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="p_image"
                        aria-describedby="emailHelp">
                      </div>

                      <button type="submit" class="btn btn-primary mr-2 p-2 rounded">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
              </div>


              <?php 
if(isset($_POST['product_btn'])){
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_model = $_POST['P_type'];
    $p_spec = $_POST['p_desc'];
    $c_id = $_POST['c_id'];
    $b_id = $_POST['b_id'];

    $p_image = $_FILES['p_image'];
    $img_name = $p_image['name'];
    $img_tmpname = $p_image['tmp_name'];
    $img_size = $p_image['size'];
    $img_type = $p_image['type'];

    // $directory = 'product_images/';
    $path = 'product_images/' . $img_name;

    move_uploaded_file($img_tmpname, $path);

    $insert = "INSERT INTO `product`(`product_name`, `product_price`, `product_type`, `product_description`, `product_image`, `category_id`, `brand_id`) 
    VALUES ('$p_name','$p_price','$p_type','$p_desc','$img_name','$c_id','$b_id')";

    $done = mysqli_query($conn, $insert);
    if($done){
        echo "<script>
        alert('Product Inserted!');
        window.location.href = 'viewProduct.php';
        </script>";
       }

}

?>
            <?php 
include("footer.php");
?>