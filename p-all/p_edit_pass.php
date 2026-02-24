<?php
$menu = "p_edit_pass";
include '../p-inc/connect.php';
include '../p-inc/header.php';
session_start();
// Fetch user information
$people_main_id = $_SESSION['people_main_id'];

$sql_user = "SELECT * FROM tbl_people_main WHERE people_main_id = '$people_main_id'";
$query_user = mysqli_query($conn, $sql_user);
$result_user = mysqli_fetch_array($query_user);

// Handle form submission for password change
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
    if ($new_password && $confirm_password && $new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update = "UPDATE tbl_people_main SET password = '$hashed_password' WHERE people_main_id = '$people_main_id'";
        if (mysqli_query($conn, $sql_update)) {
            echo "<script>";
            echo      "swal({
                title: 'แก้ไขรหัสผ่านสำเร็จ',
                text:'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                type: 'success',
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
        } else {
            echo "<script>";
            echo      "swal({
                            title: 'แก้ไขรหัสผ่านไม่สำเร็จ',
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
        echo "<script>";
        echo      "swal({
                        title: 'รหัสผ่านไม่ตรงกัน',
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
}
?>

<section class="content-header">
    <div class="container-fluid">
        <h1>
            <strong>
                <i class="nav-icon fas fa-key" style="color: green;"></i> : <span style="color: green;">รหัสผ่านผู้ใช้งาน</span>
            </strong>
        </h1>
        <hr style="border: 1px solid lightgreen;">
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="card-title"><i class="nav-icon fas fa-list-alt"></i> : เปลี่ยนรหัสผ่าน</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="mg_password.php">
                <div class="form-group">
                    <label for="username">ชื่อ:</label>
                    <input type="text" id="username" class="form-control"
                        value="<?php echo htmlspecialchars($result_user['name'] . " " . $result_user['sname']); ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="new_password">เปลี่ยนรหัสผ่าน ใหม่:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">ยืนยันรหัสผ่าน อีกครั้ง:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-edit"></i> -
                    ยืนยันรหัสผ่าน</button>
            </form>
        </div>
    </div>
</section>

<?php include '../p-inc/footer.php'; ?>
<?php
$conn->close();
?>
</body>

</html>