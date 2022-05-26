<!-- PHP 8.1.2 -->
<?php

session_start();
require_once 'config/db.php';
// if (!isset($_SESSION['user_login'])) {
//   $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
//   header('location: ../registeration-system/signin.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include 'component/head.php';?>


<body>

  <!-- ---------------------import header------------------------ -->
  <?php include 'component/header.php';?>


   <!-- -------------------------------------------->
   <?php
        $stmt = $conn->query("SELECT * FROM courses");
        $stmt->execute();
        $courses = $stmt->fetchAll(); ?>

   <!-- -------------------------------------------->


  <div class="p-5 my-1 rounded-3">
    <div class="container-fluid">

    <div class="row">
      <div class="col-md-5 col-lg-5 bg-light rounded-3 p-5">

        <h4 class="mb-3">สมัครคอร์สเรียน</h4>

        <form class="needs-validation" novalidate="" action="insertApply.php" method="post" name="applyCourse">
          
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
                        echo "<script>alert('รหัสนักเรียนไม่ถูกต้อง');</script>";
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

        <div class="row g-3">
            <div class="col-sm-6">
            <label for="id_course" class="form-label">รหัสคอร์ส</label>
            <select name="id_course" id="myTable" class="form-select col-12 col-lg-auto mb-3 mb-lg-0" aria-label="รหัสคอร์ส">
                <?php foreach ($courses as $course): ?>
                    <option><?=$course["id"]?></option>
                <?php endforeach ?>
        </select>
            </div>

            <div class="col-sm-6">
              <label for="id_member" class="form-label">รหัสนักเรียน</label>
              <input type="text" name="id_member" class="form-control" id="id_member" placeholder="รหัสนักเรียน" value="" required="">
            </div>
            <button class="w-100 btn btn-primary btn-lg" type="submit" name="applyCourse" value="Insert Data">ยืนยัน</button>
        </form>
      </div>
      </div>

      <div class="col-md-7 col-lg-7 bg-light text-white rounded-3 p-5">
      <!-- <img src="component/image/coverStudent.jpeg" class="img-fluid" alt="coverStudent"> -->

<!-- ----------search--------------------- -->

<div class="container d-flex flex-wrap justify-content-center">

<div class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none"></div>
<form class="col-12 col-lg-auto mb-3 mb-lg-0">
    <input type="search" class="form-control" id="myInput" placeholder="ค้นหา..." aria-label="Search">
</form>
</div>

<!-- ----------------------------------------- -->
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
        <th scope="col">ID Student</th>
    <th scope="col">ID Course</th>
    <th scope="col">วิชา</th>
    <th scope="col">เรื่อง</th>
    <th scope="col">ราคา</th>
    <th scope="col">ชื่อ</th>
    <th scope="col">นามสกุล</th>
    <th scope="col">โทร</th>

        </tr>
    </thead>
    <tbody id="myTable">
        <?php
$stmt = $conn->query("SELECT 
                        r.id_member AS id_member,
                        r.id_course AS id_course,
                        c.subject AS subject,
                        c.title AS title,
                        c.price AS price,
                        m.name AS name,
                        m.surname AS surname,
                        m.phone AS phone
                      FROM reg_courses as r
                      INNER JOIN courses as c ON r.id_course = c.id
                      INNER JOIN members as m ON r.id_member = m.id");
$stmt->execute();
$regs = $stmt->fetchAll();

if (!$regs) {
echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
} else {
foreach ($regs as $reg) {
?>
            <tr>
                <th scope="row"><?php echo $reg['id_member']; ?></th>
                <td><?php echo $reg['id_course']; ?></td>
                <td><?php echo $reg['subject']; ?></td>
                <td><?php echo $reg['title']; ?></td>
                <td><?php echo $reg['price']; ?></td>
                <td><?php echo $reg['name']; ?></td>
                <td><?php echo $reg['surname']; ?></td>
                <td><?php echo $reg['phone']; ?></td>
            </tr>
        <?php }}?>
    </tbody>
    </table>
</div>

<!-- ----------------------- -->
      </div>

      <!-- -------------------------------------------------- -->
    </div>

    <!-- ----------------------import footer-------------------------- -->
    <?php include 'component/footer.php';?>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
