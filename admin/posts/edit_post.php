
<?php

    include  "../layouts/navbar_side.php";

    include "../../dbconnect.php";
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();


        $id = $_GET['id'];

        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $post = $stmt->fetch();




        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $user_id = 1;


            $image_array = $_FILES['image'];
            if(isset($image_array) &&  $image_array['size'] > 0){
                $dir = '../images/';
                $image_dir = $dir.$image_array['name'];
                $image = 'images/'.$image_array['name'];
                $tmp_name = $image_array['tmp_name'];
                move_uploaded_file($tmp_name,$image_dir);
            }
            
            
            


            $sql = "UPDATE posts SET title=:title, image=:image, description=:description, category_id=:category_id, user_id=:user_id WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$id);
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
        <h3 class="d-inline">Post Lists</h3>
        <a href="" class="btn btn-danger float-end">Cancel</a>
    </div>
    <p> <a href="">Dashboard</a> /
         <a href="posts.php"> Posts</a> /
         Edit Posts</p>
    <div class="my-3">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Edit Posts" class="form-control">
            <div class="card">
                <div class="card-body">
                    <div class="m-2">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" placeholder="" class="form-control" name="title" value="<?= $post['title'] ?>">
                        
                    </div>
                    <div class="m-2">
                        <label for="name" class="form-label">Categories</label>
                        <select name="category_id" id="" class="form-select">
                            <option selected>Choose.....</option>
                            <?php
                                foreach($categories as $category){
                            ?>

                                    <option value="<?= $category['id']?>" <?php if($post['category_id'] == $category['id']) { echo "selected";} ?>> <?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <img src="../<?= $post['image'] ?>" alt="" class="w-50 h-50 py-5">
                            </div>
                            <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0"><input class="form-control my-5" type="file" id="formFile" name="image"></div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control"  rows="3" name="description" id="description"><?= $post['description'] ?></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<?php
    include  "../layouts/footer_side.php";


?>