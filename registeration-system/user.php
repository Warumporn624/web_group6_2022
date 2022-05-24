<!-- PHP 8.1.2 -->
<?php

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include '../component/head.php';?>


<body>

<!-- ---------------------import header------------------------ -->
    <?php include '../component/header.php';?>
    
<div class="p-4 rounded-3">

<div class="p-1 text-center">
      <h1 class="display-4 fw-normal">รายละเอียดคอร์ส</h1>
      <p class="fs-5 text-muted">รายละเอียดคอร์สมัธยมปลาย รวมทุกวิชา</p>
</div>

<div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

<?php
    $stmt = $conn->query("SELECT * FROM courses");
    $stmt->execute();
    $courses = $stmt->fetchAll();

    if (!$courses) {
        echo " No courses found";
    } else {
        foreach ($courses as $course) {

?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                               
                                <rect width="100%" height="100%" fill="#55595c"></rect>
                            </svg> -->
                           <img class="rounded" width="100%" src="../component/image/<?php echo $course['img']; ?>" alt="">

                            <div class="card-body">
                                <p class="card-text"><?= $course['detail']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">ID: <?= $course['id']; ?></button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">ราคา: <?= $course['price']; ?></button>
                                    </div>
                                    <small class="text-muted"><?= $course['hour']; ?> ชั่วโมง</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
        }
    }
    ?>
                   
        </div>
    </div>

  
<!-- ----------------------import footer-------------------------- -->
<?php include '../component/footer.php';?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>
</body>

</html>




