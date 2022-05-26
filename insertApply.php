<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['applyCourse'])) {
        $id_course	 = $_POST['id_course'];
        $id_member = $_POST['id_member'];
 
        if (empty($id_member)) {
            $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบถ้วน';
            header("location: apply.php");
        } 
         else {
            try {

                $check_idStudent = $conn->prepare("SELECT id FROM members WHERE id like :id_member");
                $check_idStudent->bindParam(":id_member", $id_member);
                $check_idStudent->execute();
                $row = $check_idStudent->fetch(PDO::FETCH_ASSOC);

                if ($row['id'] != $id_member) {
                    $_SESSION['warning'] = "รหัสนักเรียนไม่ถูกต้อง";
                    header("location: apply.php");
                } else if (!isset($_SESSION['error'])) {
                    $stmt = $conn->prepare("SET FOREIGN_KEY_CHECKS=0;
                                            INSERT INTO reg_courses(id_member, id_course) 
                                            VALUES(:id_member,:id_course)");
                    $stmt->bindParam(":id_member", $id_member);
                    $stmt->bindParam(":id_course", $id_course);

                    $stmt->execute();
                    $_SESSION['success'] = '<strong>รหัสนักเรียน: ' .$id_member. '</strong><br>สมัครคอร์สเรียนสำเร็จ!';
                    // header("refresh:2;registerStudent.php");
                    header("location: apply.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: apply.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>