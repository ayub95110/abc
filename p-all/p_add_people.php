<?php
session_start();
// ตรวจสอบสิทธิ์ admin (id_level = 1)
if (!isset($_SESSION['id_level']) || $_SESSION['id_level'] != 1) {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location.href='p_main.php';</script>";
    exit();
}
$menu = "p_people_all";
include '../p-inc/connect.php';
include '../p-inc/header.php';

// หากมีการส่งข้อมูล (POST) เข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : null;
    $cid = isset($_POST['cid']) ? mysqli_real_escape_string($conn, $_POST['cid']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : null;
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
    $sname = isset($_POST['sname']) ? mysqli_real_escape_string($conn, $_POST['sname']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $sex = isset($_POST['sex']) ? mysqli_real_escape_string($conn, $_POST['sex']) : null;
    $birthday = isset($_POST['birthday']) ? mysqli_real_escape_string($conn, $_POST['birthday']) : null;
    $id_level = isset($_POST['id_level']) ? mysqli_real_escape_string($conn, $_POST['id_level']) : null;
    $people_type_id = isset($_POST['people_type_id']) ? mysqli_real_escape_string($conn, $_POST['people_type_id']) : null;
    $hospital_departmen_id = isset($_POST['hospital_departmen_id']) ? mysqli_real_escape_string($conn, $_POST['hospital_departmen_id']) : null;

    // ตรวจสอบข้อมูลที่จำเป็น
    if (
        $username !== null && $cid !== null && $password !== null && $title !== null && $name !== null && $sname !== null
        && $sex !== null && $birthday !== null && $id_level !== null
        && $people_type_id !== null && $hospital_departmen_id !== null
    ) {
        // ตรวจสอบ username ซ้ำ
        $check_sql = "SELECT * FROM tbl_people_main WHERE username = '$username'";
        $check_query = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_query) > 0) {
            echo "<script>";
            echo "swal({
                    title: 'Username ซ้ำ',
                    text:'Username นี้มีอยู่ในระบบแล้ว กรุณาใช้ Username อื่น',
                    type: 'warning',
                    confirmButtonText: 'ตกลง',
                    })";
            echo "</script>";
        } else {
            // เข้ารหัส password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO tbl_people_main (username, cid, password, title, name, sname, email, phone, sex, birthday, id_level, people_type_id, hospital_departmen_id) 
                VALUES ('$username', '$cid', '$hashed_password', '$title', '$name', '$sname', '$email', '$phone', '$sex', '$birthday', '$id_level', '$people_type_id', '$hospital_departmen_id')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>";
                echo "swal({
                        title: 'เพิ่มข้อมูลสำเร็จ',
                        text:'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                        type: 'success',
                        confirmButtonText: 'ตกลง',
                        },
                        function(isConfirm){
                        if(isConfirm)
                        {
                            window.location.href='p_people_all.php';
                        }
                        else
                        {
                        }
                        }
                        )";
                echo "</script>";
            } else {
                echo "<script>";
                echo "swal({
                        title: 'เพิ่มข้อมูลไม่สำเร็จ',
                        text:'" . mysqli_error($conn) . "',
                        type: 'error',
                        confirmButtonText: 'ตกลง',
                        })";
                echo "</script>";
            }
        }
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <h1>
                    <strong>
                        <i class="fa fa-user-plus" aria-hidden="true"></i> : เพิ่มข้อมูลบุคลากรใหม่
                    </strong>
                </h1>
            </div>
            <div class="col-sm-2">
                <a href="p_people_all.php" class="btn btn-secondary btn-sm w-100">
                    <i class="fas fa-arrow-left"></i> กลับหน้า จัดการผู้ใช้งาน
                </a>
            </div>
        </div>
        <hr style="border: 1px solid lightgreen;">
    </div>
</section>

<section class="content">
    <form method="POST" action="">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title"> <i class="nav-icon fas fa-list-alt"></i> : รายละเอียด </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="username">Username: <span class="text-danger">*</span></label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="cid">รหัสประจำตัว 13 หลัก: <span class="text-danger">*</span></label>
                        <input type="text" id="cid" name="cid" class="form-control" maxlength="13" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="password">รหัสผ่าน: <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>อีเมลล์:</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="title">คำนำหน้า: <span class="text-danger">*</span></label>
                        <select id="title" name="title" class="form-control select2" required>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ชื่อ: <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>นามสกุล: <span class="text-danger">*</span></label>
                        <input type="text" id="sname" name="sname" class="form-control" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>เพศ: <span class="text-danger">*</span></label>
                        <select style="height:40px;" class="form-control select2" name="sex" required>
                            <?php
                            $sql_sex = "SELECT * FROM tbl_people_sex";
                            $query_sex = mysqli_query($conn, $sql_sex);
                            while ($result_sex = mysqli_fetch_array($query_sex)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($result_sex['sex']); ?>">
                                    <?php echo htmlspecialchars($result_sex['sex_name']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>เบอร์โทร:</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>วันเดือนปีเกิด: <span class="text-danger">*</span></label>
                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>สถานะการทำงาน: <span class="text-danger">*</span></label>
                        <select style="height:40px;" class="form-control select2" name="people_type_id" required>
                            <?php
                            $sql_people_type = "SELECT * FROM tbl_people_type";
                            $query_people_type = mysqli_query($conn, $sql_people_type);
                            while ($result_people_type = mysqli_fetch_array($query_people_type)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($result_people_type['people_type_id']); ?>">
                                    <?php echo htmlspecialchars($result_people_type['people_type_name']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>กลุ่มงาน: <span class="text-danger">*</span></label>
                        <select id="hospital_departmen_name" class="form-control select2" name="hospital_departmen_id" required>
                            <?php
                            $sql_hospital_departmen = "SELECT * FROM tbl_hospital_departmen";
                            $query_hospital_departmen = mysqli_query($conn, $sql_hospital_departmen);
                            while ($result_hospital_departmen = mysqli_fetch_array($query_hospital_departmen)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($result_hospital_departmen['hospital_departmen_id']); ?>">
                                    <?php echo htmlspecialchars($result_hospital_departmen['hospital_departmen_name']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ประเภทเจ้าหน้าที่: <span class="text-danger">*</span></label>
                        <select id="id_level" class="form-control select2" name="id_level" required>
                            <?php
                            $sql_id_level = "SELECT * FROM tbl_id_level";
                            $query_id_level = mysqli_query($conn, $sql_id_level);
                            while ($result_id_level = mysqli_fetch_array($query_id_level)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($result_id_level['id_level']); ?>">
                                    <?php echo htmlspecialchars($result_id_level['level']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <button type="submit" class="btn btn-success btn-block">บันทึก</button>
            </div>
        </div>
    </form>
</section>
<br>
<?php include '../p-inc/footer.php'; ?>
</body>

</html>