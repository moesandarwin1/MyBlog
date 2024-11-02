<?php
    include  "../layouts/navbar_side.php";



    include "../../dbconnect.php";
    $sql = "SELECT * FROM categories ORDER BY id DESC ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();



?>
<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Categories Lists</h3>
        <a href="" class="btn btn-primary float-end">Create Category</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                <tbody>
                    <?php
                        foreach($categories as $category){

                    ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><?= $category['name'] ?></td>
    
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>






<?php
    include  "../layouts/footer_side.php";


?>