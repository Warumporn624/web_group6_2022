<?php

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!-- <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-2 border-bottom">
  <a class="d-flex align-items-center text-dark text-decoration-none" href="#">
      <img src="../component/image/logo.png" alt="logo" width="85" height="50" class="d-inline-block align-text-top">
      <span class="fs-4">โรงเรียนกวดวิชา The Brain</span>
  </a>
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="../registeration-system/user.php">หน้าเเรก</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">สมัครคอร์ส</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">จัดการคอร์ส</a>
        <a href="../registerStudent/registerStudent.php" class="me-3 py-2 btn btn-primary">ลงทะเบียนนักเรียนใหม่</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="../signout.php">Logout</a>

    </nav>
    </div>
    </header>

  <div class="container d-flex flex-wrap mb-1">
  <p class="d-flex align-items-center text-dark text-decoration-none">
      <img src="../component/image/avartar.jpg" alt="avatar" width="30" height="30" class="d-inline-block align-text-top">
      <span class="fs-6">เข้าสู่ระบบโดย: <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>   </span>
  </p>
  </div> -->



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

    <a href="../registeration-system/user.php" class="navbar-brand">The Brain | </a>   
  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="../registeration-system/user.php" class="nav-item nav-link">หน้าเเรก</a>
                <a href="#" class="nav-item nav-link">สมัครคอร์ส</a>
                <a href="#" class="nav-item nav-link">จัดการคอร์ส</a>
              	<a href="../registerStudent/registerStudent.php" class="nav-item nav-link">ลงทะเบียนนักเรียนใหม่</a>
            </div>
            <div class="navbar-nav ms-auto">              	
                <a href="../signout.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container d-flex flex-wrap m-1">
  <p class="d-flex align-items-center text-dark text-decoration-none">
      <img src="../component/image/avartar.jpg" alt="avatar" width="30" height="30" class="d-inline-block align-text-top">
      <span class="fs-6">เข้าสู่ระบบโดย: <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>   </span>
  </p>
</div>

