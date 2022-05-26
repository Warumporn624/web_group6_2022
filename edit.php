<?php 

    session_start();

    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $subject = $_POST['subject'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $hour = $_POST['hour'];
        $lecturer = $_POST['lecturer'];
        $detail = $_POST['detail'];


        $sql = $conn->prepare("UPDATE courses SET subject = :subject, title = :title, price = :price, hour = :hour, lecturer = :lecturer, detail = :detail WHERE id like :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":subject", $subject);
        $sql->bindParam(":title", $title);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":hour", $hour);
        $sql->bindParam(":lecturer", $lecturer);
        $sql->bindParam(":detail", $detail);
        $sql->execute();


        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: manage.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: manage.php");
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
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-6 bg-light rounded-3 p-4">
                    <h1>เเก้ไขข้อมูลคอร์สเรียน</h1>
                    <hr>
                    <form action="edit.php" method="post">
                        <?php
                            if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $stmt = $conn->query("SELECT * FROM courses WHERE id='$id'");
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                            }
                        ?>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">ID:</label>
                                <input type="text" readonly value="<?php echo $data['id']; ?>" required class="form-control" name="id" >  
                            </div>

                            <label for="title" class="col-form-label">Subject/Title:</label>
                        <div class="input-group">
                            <select class='btn btn-outline-secondary' required name='subject'>
                                <option selected value='<?= $data['subject']; ?>'><?= $data['subject']; ?></option>
                                <option value="Biology">Biology</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Physics">Physics</option>
                                <option value="Mathematics">Mathematics</option>
                            </select>
                            <div class="input-group-append">
                                <input type="text" required value='<?= $data['title']; ?>' class="form-control" name='title'>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" required class="col-form-label">Price:</label>
                            <div class='input-group'>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">฿</span>
                                </div>
                                <input type="number" required value='<?= $data['price']; ?>' min='0' max='10000' step='100' class="form-control" name='price'>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="hour" class="col-form-label">Hour:</label>
                            <input type="number" required value='<?= $data['hour']; ?>' min='0' max='100' class="form-control" name='hour'>
                        </div>
                        <div class="mb-3">
                            <label for="lecturer" class="col-form-label">Lecturer:</label>
                            <input type="text" required value='<?= $data['lecturer']; ?>' class="form-control" name='lecturer'>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="col-form-label">Detail:</label>
                            <textarea class="form-control" name='detail' rows="5"><?= $data['detail']; ?></textarea>
                        </div>

                            <hr>
                            <a href="manage.php" class="btn btn-secondary">Go Back</a>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                </div>

                <div class="col-md-7 col-lg-6 bg-light text-white rounded-3 p-3">

                </div>

            </div>
        </div>

    </div>


    <!-- ----------------------import footer-------------------------- -->
    <?php include 'component/footer.php';?>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>


