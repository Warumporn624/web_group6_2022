<!-- PHP 8.1.2 -->
<?php

session_start();
require_once '../registeration-system/config/db.php';
// if (!isset($_SESSION['user_login'])) {
//   $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
//   header('location: ../registeration-system/signin.php');
// }
?>
<!DOCTYPE html>
<html lang="en">

<!-- ---------------------import head------------------------ -->
<?php include '../component/head.php';?>


<body>
  <div class="container py-3">
    
  <!-- ---------------------import header------------------------ -->
  <?php include '../component/header.php';?>


    <div class="container-fluid">

      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">ลงทะเบียนนักเรียนใหม่</h4>

        <form class="needs-validation" novalidate="" action="insertStudent.php" method="post" name="registerStudent">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">ชื่อ</label>
              <input type="text" name="name" class="form-control" id="firstName" placeholder="ชื่อจริง" value="" required="">
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">นามสกุล</label>
              <input type="text" name="surname" class="form-control" id="lastName" placeholder="นามสกุล" value="" required="">
            </div>

            <div class="row g-3">
              <div class="col-sm-6">
              <label for="birthday">วันเกิด:</label>
              <input type="text" name="birthday" class="date form-control" required=""/>
              <script type="text/javascript">
                $(".date").datepicker({
                format: "yyyy-mm-dd",
                });
              </script>
            </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">อีเมล</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="xxxx@gmail.com" value="" required="">
            </div>

            <div class="col-12">
              <label for="address" class="form-label">ที่อยู่</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="xxxx ถนนเจริญกรุง" required="">
            </div>

            <div class="col-12">
              <label class="form-label" for="typePhone">เบอร์โทรศัพท์</label>
              <input class="form-control" name="phone" id="phone" name="telNo" type="tel" minlength="10" maxlength="10" placeholder="0123456789" required="">
            </div>


            <div class="col-12">
              <label for="school" class="form-label">โรงเรียน</label>
              <input type="text" name="school" class="form-control" id="school" placeholder="สตรีวิทย์" required="">
            </div>

            <div class="col-md-5">
              <label for="education" class="form-label">ระดับการศึกษา</label>
              <select class="form-select" name="education" id="education" required="">
                <option value="">เลือก...</option>
                <option>ม.4</option>
                <option>ม.5</option>
                <option>ม.6</option>
              </select>
            </div>

            <button class="w-100 btn btn-primary btn-lg" type="submit" name="signupStudent" value="Insert Data">ลงทะเบียน</button>
        </form>
      </div>

    </div>

    <!-- ----------------------import footer-------------------------- -->
    <?php include '../component/footer.php';?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>