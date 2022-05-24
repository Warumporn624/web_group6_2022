<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include '../component/head.php';?>

 <body class="text-center">

 <!-- <main class="form-signin"> -->
 <div class="p-5 my-4 rounded-3">

 <div class="d-flex justify-content-center">
        <form action="signin_db.php" method="post">
        <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <img class="img-fluid" src="../component/image/logoCrop.png" alt="" width="130" height="100">
            <h1 class="h3 mb-3 fw-normal">เข้าสู่ระบบ</h1>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="name@example.com">
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="password" class="form-label">Password</label>
            </div>
            <button type="submit" name="signin" class="w-100 btn btn-lg btn-primary mt-3">Sign In</button>
            <hr>
        <p>คลิกที่นี่เพื่อ <a href="index.php">สมัครเป็น Admin</a></p>
        </form>
        
 </div>
 </div>
</body> 

</html> 


