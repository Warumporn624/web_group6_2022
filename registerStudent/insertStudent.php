
<?php 

    session_start();
    require_once '../registeration-system/config/db.php';

    if (isset($_POST['signupStudent'])) {
        $name	 = $_POST['name'];
        $surname = $_POST['surname'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $phone	  = $_POST['phone'];
        $email	  = $_POST['email'];
        $school = $_POST['school'];
        $education = $_POST['education'];

        if (empty($name)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: registerStudent.php");

        } else if (empty($surname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: registerStudent.php");

        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: registerStudent.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: registerStudent.php");

        } else if (strlen($_POST['phone']) > 10 || strlen($_POST['phone']) < 10) {
            $_SESSION['error'] = 'เบอร์โทรศัพท์ผ่านต้องมีความยาว 10 ตัวเลข';
            header("location: registerStudent.php");

        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM members WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "มีอีเมลนี้ได้ทำการลงทะเบียนไปเเล้ว";
                    header("location: registerStudent.php");
                } else if (!isset($_SESSION['error'])) {
                    $stmt = $conn->prepare("INSERT INTO members(name,surname,birthday,address,phone,email,school,education) 
                                            VALUES(:name,:surname,:birthday,:address, :phone,:email,:school,:education)");
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":surname", $surname);
                    $stmt->bindParam(":birthday", $birthday);
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":school", $school);
                    $stmt->bindParam(":education", $education);

                   
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกนักเรียนเรียบร้อยแล้ว! <a href='registerStudent.php' class='alert-link'>คลิกที่นี่</a> เพื่อสมัครคอร์ส";
                    // header("refresh:2;registerStudent.php");
                    header("location: registerStudent.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: registerStudent.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>