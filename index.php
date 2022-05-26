<?php 

    session_start();
    require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include 'component/head.php';?>

<body>
<div class="p-5 my-4 rounded-3">

    <div class="container-fluid">

    <div class="row">
    <div class="col-md-5 col-lg-6 bg-light rounded-3 p-5">

        <h3 class="mt-4">ลงทะเบียนพนักงานใหม่</h3>
        <!-- <hr> -->
        <form action="signup_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo "<script>alert('สมัครเรียบร้อยแล้ว');</script>";
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo "<script>alert('มีอีเมลนี้อยู่ในระบบแล้ว');</script>";
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

        <div class="row g-3">

            <div class="col-sm-6">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
            </div>
            <div class="col-sm-6">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
            </div>
        </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="c_password">
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        <hr>
        <p>คลิกที่นี่เพื่อ <a href="signin.php">เข้าสู่ระบบ</a></p>
        </form>
    </div>

    <div class="col-md-7 col-lg-6 bg-light text-white rounded-3 p-5">

    <img src="component/image/staff.jpeg" class="img-fluid" alt="staff">

    </div>

    </div>
      <!-- ----------------------import footer-------------------------- -->
      <?php include 'component/footer.php';?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
