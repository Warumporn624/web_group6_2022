<?php 

    // session_start();
    // require_once 'config/db.php';
    // if (!isset($_SESSION['admin_login'])) {
    //     $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    //     header('location: signin.php');
    // }

?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <?php 

            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
        <h3 class="mt-4">Welcome Admin, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h3>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html> -->