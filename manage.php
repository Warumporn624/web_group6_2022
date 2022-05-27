<?php

session_start();

require_once "config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM courses WHERE id='$delete_id'");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=manage.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include 'component/head.php';?>

<body>

<!-- ---------------------import header------------------------ -->
<?php include 'component/header.php';?>

<div class="container my-1">
<div class="p-2 my-1 rounded-3">

<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มคอร์สเรียน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="insertCourse.php" method="post">
                    <label for="title" class="col-form-label">Subject/Title:</label>
                        <div class="input-group">
                            <select class='btn btn-outline-secondary' required name='subject'>
                                <option value=''>Choose...</option>
                                <option value="Biology">Biology</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Physics">Physics</option>
                                <option value="Mathematics">Mathematics</option>
                            </select>
                                <div class="input-group-append">
                                    <input type="text" required class="form-control" name='title' placeholder="title">
                                </div>
                        </div>

                        <div class="mb-3">
                            <label for="id" class="col-form-label">ID:</label>
                            <input type="text" required class="form-control" name='id' placeholder="Course ID">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="col-form-label">Price:</label>
                            <div class='input-group'>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">฿</span>
                                </div>
                                <input type="number" required min='0' max='10000' step='100' class="form-control" name='price'>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="hour" class="col-form-label">Hour:</label>
                            <input type="number" required min='0' max='100' class="form-control" name='hour'>
                        </div>
                        <div class="mb-3">
                            <label for="lecturer" class="col-form-label">Lecturer:</label>
                            <input type="text" required class="form-control" name='lecturer'>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="col-form-label">Detail:</label>
                            <textarea class="form-control" name='detail' rows="5"></textarea>
                        </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </div>
                </form>
            </div>

        </div>
    </div>
</div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-6">
                <h1>จัดการคอร์สเรียน</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal" data-bs-whatever="@mdo">เพิ่มคอร์สเรียน</button>
            </div>
        </div>
        <hr>

<!-- ----------search--------------------- -->

    <div class="container d-flex flex-wrap justify-content-center">

        <div class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none"></div>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0">
            <input type="search" class="form-control" id="myInput" placeholder="ค้นหา..." aria-label="Search">
        </form>
    </div>

<!-- ----------------------------------------- -->

        <?php if (isset($_SESSION['success'])) {?>
            <div class="alert alert-success">
                <?php
echo $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
            </div>
        <?php }?>
        <?php if (isset($_SESSION['error'])) {?>
            <div class="alert alert-danger">
                <?php
echo $_SESSION['error'];
    unset($_SESSION['error']);
    ?>
            </div>
        <?php }?>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
            <th scope="col">Subject วิชา</th>
            <th scope="col">Title เรื่อง</th>
            <th scope="col">Price ราคา</th>
            <th scope="col">Hour ชั่วโมง</th>
            <th scope="col">Lecturer ผู้สอน </th>
            <th scope="col">Detail รายละเอียด</th>
            <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
$stmt = $conn->query("SELECT * FROM courses");
$stmt->execute();
$courses = $stmt->fetchAll();

if (!$courses) {
    echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
} else {
    foreach ($courses as $course) {
        ?>
                    <tr>
                        <th scope="row"><?php echo $course['id']; ?></th>
                        <td><?php echo $course['subject']; ?></td>
                        <td><?php echo $course['title']; ?></td>
                        <td><?php echo $course['price']; ?></td>
                        <td><?php echo $course['hour']; ?></td>
                        <td><?php echo $course['lecturer']; ?></td>
                        <td style="word-wrap: break-word;min-width: 200px;max-width: 300px;"><?=$course['detail']?></td>
                        <td>                        
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <button href="edit.php?id=<?php echo $course['id']; ?>" class="btn btn-warning me-md-2" type="button">Edit</button> -->
                                <a href="edit.php?id=<?php echo $course['id']; ?>" class="btn btn-warning me-md-2">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $course['id']; ?>" class="btn btn-danger">Delete</a> 
                            </div>                                                   
                        </td>
                    </tr>
                <?php }}?>
            </tbody>
            </table>
    </div>
    </div>
</div>

    <!-- ----------------------import footer-------------------------- -->
    <?php include 'component/footer.php';?>

</div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        $(".response").delay(1000).hide(1000);
    </script>

</body>
</html>
