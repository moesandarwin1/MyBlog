
<?php

    include  "../layouts/navbar_side.php";

    include "../../dbconnect.php";
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();




        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $user_id = 1;


            $image_array = $_FILES['image'];
            if(isset($image_array) &&  $image_array['size'] > 0){
                $dir = '../images/';
                $image_dir = $dir.$image_array['name'];
                $image = 'admin/images/'.$image_array['name'];
                $tmp_name = $image_array['tmp_name'];
                move_uploaded_file($tmp_name,$image_dir);
            }
            
            
            


            $sql = "INSERT INTO posts (title,image,description,category_id,user_id) VALUES(:title,:image,:description,:category_id,:user_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title',$title);
            $stmt->bindParam(':image',$image);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':category_id',$category_id);
            $stmt->bindParam(':user_id',$user_id);
            $stmt->execute();

            header("location: posts.php");

            //echo "$title <br> $category_id <br>$description";
        }
    

?>



<div class= "container my-5">
    <div>
        <h3 class="d-inline">Posts Lists</h3>
        <a href="" class="btn btn-danger float-end">Cancel</a>
    </div>
    <p> <a href="">Dashboard</a> /
         <a href="">Posts</a> /
        Posts</p>
    <div class="my-3">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Create Posts" class="form-control">
            <div class="card">
                <div class="card-body">
                    <div class="m-2">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" placeholder="" class="form-control" name="title">
                        
                    </div>
                    <div class="m-2">
                        <label for="name" class="form-label">Categories</label>
                        <select name="category_id" id="" class="form-select">
                            <option selected>Choose.....</option>
                            <?php
                                foreach($categories as $category){
                            ?>

                                    <option value="<?= $category['id']?>"> <?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control"  rows="3" name="description" id="description"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php
    include  "../layouts/footer_side.php";


?>