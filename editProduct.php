<?php 
include("header.php");
include("connection.php");

if (isset($_GET['i'])) {
$p_id = $_GET['i'];

$select = "SELECT p.*, c.category_name, b.brand_name 
FROM `product` p
INNER JOIN `category` c
ON p.category_id = c.category_id
INNER JOIN `brand` b
ON p.brand_id = b.brand_id 
WHERE p.product_id = $p_id";

$row = mysqli_query($conn, $select);

$data = mysqli_fetch_assoc($row);

?>
<style>
input:focus {
    color: white !important; 
}

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
                    <h4 class="card-title">EDIT PRODUCT</h4>
              
                    <label for="">Category Name</label>
                    <select name="c_id" class="form-select mb-3" aria-label="Default select example">
                             
                             <?php
                             $category = "SELECT * FROM category";
                             $cat_query = mysqli_query($conn, $category);
                             while($cat_data = mysqli_fetch_assoc($cat_query)){ ?>

                                 <option value="<?php echo $cat_data['category_id']?>" <?php if($data['category_id'] == $cat_data['category_id']){ echo "selected = 'selected'";}?> > <?php echo $cat_data['category_name']?> </option>
                          <?php   }
                             ?>
                             
                         </select>

                         <label for="">Brand Name</label>
                         <select name="b_id" class="form-select mb-3" aria-label="Default select example">
                             <option selected>Select Brand</option>

                             <?php
                                 $brands = "SELECT * FROM brand";
                                 $br_query = mysqli_query($conn, $brands);
                             while($option = mysqli_fetch_assoc($br_query)){ ?>
                                 <option value=" <?php echo $option['brand_id']?>" <?php if($data['brand_id'] == $option['brand_id']){
                                     echo 'selected';
                                 }
                                 
                                 ?>> <?php echo $option['brand_name']?> </option>
                          <?php   }
                             ?>

                         </select>


                    <form class="forms-sample">
                      <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                    <input type="text" value='<?php echo $data['product_name']  ?>' class="form-control" id="exampleInputEmail1" name="p_name"
                                        aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Product Price</label>
                                    <input type="text" value='<?php echo $data['product_price']  ?>' class="form-control" id="exampleInputEmail1" name="p_price"
                                        aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Product Type</label>
                                    <input type="text" value='<?php echo $data['product_type']  ?>' class="form-control" id="exampleInputEmail1" name="p_type"
                                        aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Product Description</label>
    <textarea class="form-control" id="exampleInputEmail1" name="p_desc" rows="5"
        aria-describedby="emailHelp"><?php echo $data['product_description'] ?></textarea>
</div>

                      
                      <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Product image</label>
                                    <input type="file" value='' class="form-control" id="exampleInputEmail1" name="p_image"
                                        aria-describedby="emailHelp">
                                        <img src="product_images/<?php echo $data['product_image']?>" alt="">
                                </div>

                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            <!-- Form End -->

         <?php
}

if (isset($_POST['update'])) {
$p_name = $_POST['p_name'];
$p_price = $_POST['p_price'];
$p_type = $_POST['p_type'];
$p_desc = $_POST['p_desc'];
$p_image = $_FILES['p_image'];
$c_id = $_POST['c_id'];
$b_id = $_POST['b_id'];

$img_name = $p_image['name'];
$img_tmpname = $p_image['tmp_name'];
$img_size = $p_image['size'];
$img_type = $p_image['type'];

$path = 'product_images/' . $img_name;

if(is_uploaded_file($img_tmpname)){
    move_uploaded_file($img_tmpname, $path);

    $update = "UPDATE `product` SET product_name = '$p_name', product_price = '$p_price', product_type = '$p_type', product_description = '$p_desc', product_image = '$img_name', category_id = '$c_id', brand_id = '$b_id' WHERE product_id = '$p_id'";
$done = mysqli_query($conn, $update);
}
else{
    $update = "UPDATE `product` SET product_name = '$p_name', product_price = '$p_price', product_type = '$p_type', product_description = '$p_desc', category_id = '$c_id', brand_id = '$b_id' WHERE product_id = '$p_id'";
    $done = mysqli_query($conn, $update);
}

if($done){
    echo "<script>
    alert('Record Updated!');
    window.location.href = 'viewProduct.php';
    </script>";
   }
        }
         ?>

<?php 
include("footer.php");
?>