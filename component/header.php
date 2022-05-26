<?php

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

    <a href="../thebrain/user.php" class="navbar-brand">The Brain | </a>   
  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="../thebrain/user.php" class="nav-item nav-link">หน้าเเรก</a>
                <a href="../thebrain/apply.php" class="nav-item nav-link">สมัครคอร์ส</a>
                <a href="../thebrain/manage.php" class="nav-item nav-link">จัดการคอร์ส</a>
              	<a href="../thebrain/registerStudent.php" class="nav-item nav-link">ลงทะเบียนนักเรียนใหม่</a>
            </div>
            <div class="navbar-nav ms-auto">              	
                <a href="../thebrain/signout.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container d-flex flex-wrap m-1">
  <p class="d-flex align-items-center text-dark text-decoration-none">
      <img src="../thebrain/component/image/avartar.jpg" alt="avatar" width="30" height="30" class="d-inline-block align-text-top">
      <span class="fs-6">เข้าสู่ระบบโดย: <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>   </span>
  </p>
</div>

