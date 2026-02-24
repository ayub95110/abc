<!DOCTYPE html>
<html lang="en">
<?php
include 'p-inc/header-login.php';
include 'p-inc/connect.php';
session_start();
?>


<body>
    <?php
    // รับค่าจากหน้า Login
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Query to fetch user information based on the username
    $sql = "SELECT * FROM tbl_people_main WHERE username = '$username'";
    $db_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($db_query)) {
        $user = mysqli_fetch_array($db_query);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // เช็คสถานะว่าอยู่ในการทำงานรึป่าว
            if ($user['people_type_id'] == 2 || $user['people_type_id'] == 3) {
                //
                echo "<script>";
                echo      "swal({
                                title: 'Username ของคุณถูกปิดใช้งาน',
                                text:'กรุณาติดต่อเจ้าหน้าที่ เพื่อดำเนินการใช้งาน',
                                type: 'warning',
                                confirmButtonText: 'ตกลง',
                                },
                                function(isConfirm){
                                if(isConfirm)
                                {
                                    window.history.back();
                                }
                                else
                                {
                                }
                                }
                                )";
                echo "</script>";
                exit;
            } else {
                // เก็บ SESSION
                $_SESSION['people_main_id'] = $user['people_main_id'];
                $_SESSION['id'] = $user['people_main_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['id_level'] = $user['id_level'];
                //
                echo "<script>";
                echo "swal({";
                echo "title: 'เข้าสู่ระบบสำเร็จ',";
                echo "text: 'กรุณารอสักครู่',";
                echo "imageUrl: 'img/load.gif',";
                // echo "type: 'success',";
                echo "showConfirmButton: false";
                echo "});";
                echo "setTimeout(function() {";
                echo "window.location='p-all/p_main.php';";
                echo "}, 1000);"; // 3 seconds delay
                echo "</script>";
            }
        } else {
            // Invalid password
            echo "<script>";
            echo      "swal({
                                title: 'รหัสผ่านไม่ถูกต้อง',
                                text:'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                                type: 'error',
                                confirmButtonText: 'ตกลง',
                                },
                                function(isConfirm){
                                if(isConfirm)
                                {
                                    window.history.back();
                                }
                                else
                                {
                                }
                                }
                                )";
            echo "</script>";
        }
    } else {
        // Invalid username
        echo "<script>";
        echo      "swal({
                                title: 'ชื่อผู้ใช้ไม่ถูกต้อง',
                                text:'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                                type: 'error',
                                confirmButtonText: 'ตกลง',
                                },
                                function(isConfirm){
                                if(isConfirm)
                                {
                                    window.history.back();
                                }
                                else
                                {
                                }
                                }
                                )";
        echo "</script>";
    }
    ?>
</body>

</html>