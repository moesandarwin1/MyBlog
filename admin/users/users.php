<?php
    include  "../layouts/navbar_side.php";



    include "../../dbconnect.php";
    $sql = "SELECT * FROM users ORDER BY id DESC ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();



?>
<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Users Lists</h3>
        <a href="" class="btn btn-primary float-end">Create Users</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $j =1 ;
                        foreach($users as $user){

                    ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><img src=<?= $user['profile'] ?> alt="" width="100px"></td>
                            <td><?= $user['role'] ?></td>
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
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Role</th>
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