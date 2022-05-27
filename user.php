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
<?php include 'component/head.php'; ?>


<body>

    <!-- ---------------------import header------------------------ -->
    <?php include 'component/header.php'; ?>


    <!-- -------------select from database---------------------------- -->


    <?php
    $stmt = $conn->query("SELECT * FROM members");
    $row_count_members = $stmt->rowCount();
    ?>

    <?php
    $stmt = $conn->query("SELECT * FROM courses");
    $row_count_courses = $stmt->rowCount();
    ?>


    <?php
    $stmt = $conn->query("SELECT * FROM reg_courses");
    $row_count_regCourses = $stmt->rowCount();
    ?>

    <?php
    $stmt = $conn->query("
                        SELECT 
                            reg.id_course as id,
                            reg.subject as subject,
                            COUNT(*) as number
                        FROM

                        (SELECT 
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
                        INNER JOIN members as m ON r.id_member = m.id) AS reg 

                        GROUP BY id, subject");
    $stmt->execute();
    $results = $stmt->fetchAll();

    ?>


    <!-- --------------------------------------------- -->
    <div class="p-4 rounded-3">

        <div class="p-1 text-center">
            <h1 class="display-4 fw-normal">Register And Course Report</h1>
            <p class="fs-5 text-muted">รายงานการสมัครเรียนเเละคอร์ส</p>
        </div>

        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <div class="col">
                    <div class="card text-center text-white" style="background-color:DodgerBlue">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนนักเรียนทั้งหมด (คน)</h5>
                            <p class="card-text" style="font-size:50px;"><?php echo $row_count_members; ?></p>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card text-center text-white" style="background-color:DodgerBlue">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนคอร์สทั้งหมด (คอร์ส)</h5>
                            <p class="card-text" style="font-size:50px;"><?php echo $row_count_courses; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-center text-white" style="background-color:DodgerBlue">
                        <div class="card-body">
                            <h5 class="card-title">การสมัครเรียนทั้งหมด (รายการ)</h5>
                            <p class="card-text" style="font-size:50px;"><?php echo $row_count_regCourses; ?></p>
                        </div>
                    </div>
                </div>

<!-- --------------------------------------------------   -->
                


            </div> <!---card-->

            <h5 class="mt-5"> สรุปรายการตามคอร์ส</h5>
        <div class="table-responsive">
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">รหัสคอร์ส</th>
                            <th scope="col">คอร์ส</th>
                            <th scope="col">จำนวนนักเรียน</th>
    
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                            $stmt = $conn->query("SELECT 
                                                    reg.id_course as id_course,
                                                    reg.subject as subject,
                                                    COUNT(*) as number
                                                    FROM

                                                    (SELECT 
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
                                                    INNER JOIN members as m ON r.id_member = m.id) AS reg 
                                                    GROUP BY id_course, subject");
                            $stmt->execute();
                            $regs = $stmt->fetchAll();

                            if (!$regs) {
                                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                            } else {
                            foreach ($regs as $reg) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $reg['id_course']; ?></th>
                                    <td><?php echo $reg['subject']; ?></td>
                                    <td><?php echo $reg['number']; ?></td>
              
                                </tr>
                            <?php }}?>
                    </tbody>
                    </table>

            </div>
        </div>


        <!-- ----------------------import footer-------------------------- -->
        <?php include 'component/footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>

</html>