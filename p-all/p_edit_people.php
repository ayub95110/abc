<?php
session_start();
// ตรวจสอบสิทธิ์: admin (id_level=1) สามารถแก้ไขข้อมูลทุกคน, user ทั่วไปแก้ไขได้เฉพาะข้อมูลตัวเอง
$is_admin = (isset($_SESSION['id_level']) && $_SESSION['id_level'] == 1);
$is_own_profile = (isset($_GET['people_main_id']) && isset($_SESSION['people_main_id']) && $_GET['people_main_id'] == $_SESSION['people_main_id']);
if (!$is_admin && !$is_own_profile) {
    echo "<script>alert('คุณไม่มีสิทธิ์เข้าใช้งานหน้านี้'); window.location.href='p_main.php';</script>";
    exit();
}
$menu = $is_admin ? "p_people_all" : "p_people_me";
include '../p-inc/connect.php';
include '../p-inc/header.php';

// ตรวจสอบว่ามีการส่ง people_main_id หรือไม่
if (!isset($_GET['people_main_id']) || !is_numeric($_GET['people_main_id'])) {
    echo "<script>alert('ข้อมูลไม่ถูกต้อง'); window.location.href='p_people_all.php';</script>";
    exit();
}
$people_main_id = intval($_GET['people_main_id']); // แปลงเป็นตัวเลขเพื่อความปลอดภัย

// หากมีการส่งข้อมูล (POST) เข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // อัปเดตข้อมูลในฐานข้อมูล
    if (
        $people_main_id !== null && $title !== null && $name !== null && $sname !== null
        && $email !== null && $sex !== null && $birthday !== null && $id_level !== null
        && $people_type_id !== null && $hospital_departmen_id !== null
    ) {

        $sql_update = "UPDATE tbl_people_main SET 
                title = '$title', 
                name = '$name', 
                sname = '$sname',
                email = '$email',
                phone = '$phone',
                sex = '$sex',
                birthday = '$birthday',
                id_level = '$id_level',
                people_type_id = '$people_type_id',
                hospital_departmen_id = '$hospital_departmen_id'
            WHERE people_main_id = $people_main_id";
        if (mysqli_query($conn, $sql_update)) {
            // อัปเดตสำเร็จ
            // echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
            echo "<script>";
            echo      "swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        text:'กรุณากด ตกลง เพื่อดำเนินการต่อ',
                        type: 'success',
                        confirmButtonText: 'ตกลง',
                        },
                        function(isConfirm){
                        if(isConfirm)
                        {
                            window.location.href='" . ($is_admin ? "p_people_all.php" : "p_people_me.php") . "';
                        }
                        else
                        {
                        }
                        }
                        )";
            echo "</script>";
        } else {
            // อัปเดตล้มเหลว
            // echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ');</script>";
            echo "<script>";
            echo      "swal({
                            title: 'บันทึกข้อมูลไม่สำเร็จ',
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
            echo $sql_update;
        }
    } else {
        echo "<script>alert('ข้อมูลไม่ถูกต้อง'); window.history.back();</script>";
    }
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM tbl_people_main 
JOIN tbl_hospital_departmen ON tbl_people_main.hospital_departmen_id = tbl_hospital_departmen.hospital_departmen_id
JOIN tbl_people_type ON tbl_people_main.people_type_id = tbl_people_type.people_type_id
JOIN tbl_people_sex ON tbl_people_main.sex = tbl_people_sex.sex
JOIN tbl_id_level ON tbl_people_main.id_level = tbl_id_level.id_level
WHERE tbl_people_main.people_main_id = $people_main_id";
$query = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($query);
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <h1>
                    <strong>
                        <a href="p_people.php" class="text-green" style="text-decoration: none;">
                            <i class="fa fa-user" aria-hidden="true"></i> : ข้อมูลส่วนตัว /
                            <?php echo $user['title'] . $user['name'] . ' ' . $user['sname'] . '  [ แก้ไข ]'; ?>
                        </a>
                    </strong>
                </h1>
            </div>
            <div class="col-sm-2">
                <?php if ($is_admin) { ?>
                    <a href="p_people_all.php" class="btn btn-secondary btn-sm w-100">
                        <i class="fas fa-arrow-left"></i> กลับหน้า จัดการผู้ใช้งาน
                    </a>
                <?php } else { ?>
                    <a href="p_people_me.php" class="btn btn-secondary btn-sm w-100">
                        <i class="fas fa-arrow-left"></i> กลับหน้า ข้อมูลส่วนตัว
                    </a>
                <?php } ?>
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
                        <label for="username">Username:</label>
                        <input type="text" id="username" value="<?php echo $user['username'] ?>" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="cid">รหัสประจำตัว 13 หลัก:</label>
                        <input type="text" id="cid" value="<?php echo $user['cid'] ?>" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>อีเมลล์:</label>
                        <input type="text" id="email" name="email" value="<?php echo $user['email'] ?>"
                            class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label for="title">คำนำหน้า:</label>
                        <select id="title" name="title" class="form-control select2">
                            <option value="นาย" <?php echo ($user['title'] == 'นาย') ? 'selected' : ''; ?>>นาย</option>
                            <option value="นาง" <?php echo ($user['title'] == 'นาง') ? 'selected' : ''; ?>>นาง</option>
                            <option value="นางสาว" <?php echo ($user['title'] == 'นางสาว') ? 'selected' : ''; ?>>นางสาว
                            </option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ชื่อ:</label>
                        <input type="text" id="name" name="name" value="<?php echo $user['name'] ?>"
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>นามสกุล:</label>
                        <input type="text" id="sname" name="sname" value="<?php echo $user['sname'] ?>"
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>เพศ:</label>
                        <!-- <input type="text" id="sex" name="sex" value="<?php echo $user['sex_name'] ?>" class="form-control"> -->
                        <select style="height:40px;" class="form-control select2" name="sex">
                            <?php
                            // SQL ดึงข้อมูลเพศ
                            $sql_sex = "SELECT * FROM tbl_people_sex";
                            $query_sex = mysqli_query($conn, $sql_sex);
                            // ค่าที่เลือกในปัจจุบัน
                            $id_sex = $user['sex'];  // assuming 'sex' column stores the selected value
                            // วนลูปแสดงตัวเลือกใน <select>
                            while ($result_sex = mysqli_fetch_array($query_sex)) {
                                $selected_id_sex = ($id_sex == $result_sex['sex']) ? 'selected' : '';  // assuming 'sex_id' is the column for IDs
                            ?>
                                <option value="<?php echo htmlspecialchars($result_sex['sex']); ?>"
                                    <?php echo $selected_id_sex; ?>>
                                    <?php echo htmlspecialchars($result_sex['sex_name']); ?>
                                    <!-- assuming 'sex_name' is the name of the sex -->
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
                        <input type="text" id="phone" name="phone" value="<?php echo $user['phone'] ?>"
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>วันเดือนปีเกิด:</label>
                        <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday'] ?>"
                            class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>อายุ:</label>
                        <input type="text" id="age" class="form-control" readonly>
                    </div>
                    <script>
                        // ฟังก์ชันสำหรับคำนวณอายุโดยแบ่งเป็นปี เดือน วัน
                        function calculateAge(birthday) {
                            const birthDate = new Date(birthday);
                            const today = new Date();
                            // คำนวณความแตกต่างในปี
                            let ageYears = today.getFullYear() - birthDate.getFullYear();
                            // คำนวณความแตกต่างในเดือน
                            let ageMonths = today.getMonth() - birthDate.getMonth();
                            if (ageMonths < 0) {
                                ageYears--; // ถ้าเดือนยังไม่ถึงเดือนเกิด ให้ลบ 1 ปี
                                ageMonths += 12; // ปรับให้เดือนเป็นค่าบวกโดยบวก 12 เดือน
                            }
                            // คำนวณความแตกต่างในวัน
                            let ageDays = today.getDate() - birthDate.getDate();
                            if (ageDays < 0) {
                                ageMonths--; // ถ้าวันยังไม่ถึงวันเกิด ให้ลบ 1 เดือน
                                const lastMonth = new Date(today.getFullYear(), today.getMonth(),
                                    0); // วันที่สุดท้ายของเดือนที่แล้ว
                                ageDays += lastMonth.getDate(); // บวกจำนวนวันของเดือนที่แล้ว
                            }
                            return `${ageYears} ปี ${ageMonths} เดือน ${ageDays} วัน`;
                        }
                        // ดึงวันเกิดจากค่า PHP และคำนวณอายุ
                        const birthday = "<?php echo $user['birthday']; ?>";
                        document.getElementById('age').value = calculateAge(birthday);
                    </script>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>สถานะการทำงาน:</label>
                        <select style="height:40px;" class="form-control select2" name="people_type_id">
                            <?php
                            // SQL ดึงข้อมูลสถานะการทำงาน
                            $sql_people_type = "SELECT * FROM tbl_people_type";
                            $query_people_type = mysqli_query($conn, $sql_people_type);
                            // ค่าที่เลือกในปัจจุบัน
                            $id_people_type = $user['people_type_id'];  // assuming 'people_type_id' column stores the selected value
                            // วนลูปแสดงตัวเลือกใน <select>
                            while ($result_people_type = mysqli_fetch_array($query_people_type)) {
                                $selected_id_people_type = ($id_people_type == $result_people_type['people_type_id']) ? 'selected' : '';  // assuming 'people_type_id' is the column for IDs
                            ?>
                                <option value="<?php echo htmlspecialchars($result_people_type['people_type_id']); ?>"
                                    <?php echo $selected_id_people_type; ?>>
                                    <?php echo htmlspecialchars($result_people_type['people_type_name']); ?>
                                    <!-- assuming 'people_type_name' is the name of the people type -->
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>กลุ่มงาน:</label>
                        <select id="hospital_departmen_name" class="form-control select2" name="hospital_departmen_id">
                            <?php
                            // SQL ดึงข้อมูลกลุ่มงาน
                            $sql_hospital_departmen = "SELECT * FROM tbl_hospital_departmen";
                            $query_hospital_departmen = mysqli_query($conn, $sql_hospital_departmen);
                            // ค่าที่เลือกในปัจจุบัน
                            $id_hospital_departmen = $user['hospital_departmen_id'];  // assuming 'hospital_departmen_id' column stores the selected value
                            // วนลูปแสดงตัวเลือกใน <select>
                            while ($result_hospital_departmen = mysqli_fetch_array($query_hospital_departmen)) {
                                $selected_id_hospital_departmen = ($id_hospital_departmen == $result_hospital_departmen['hospital_departmen_id']) ? 'selected' : '';  // assuming 'hospital_departmen_id' is the column for IDs
                            ?>
                                <option
                                    value="<?php echo htmlspecialchars($result_hospital_departmen['hospital_departmen_id']); ?>"
                                    <?php echo $selected_id_hospital_departmen; ?>>
                                    <?php echo htmlspecialchars($result_hospital_departmen['hospital_departmen_name']); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>ประเภทเจ้าหน้าที่:</label>
                        <select id="id_level" class="form-control select2" name="id_level">
                            <?php
                            // SQL ดึงข้อมูลประเภทเจ้าหน้าที่
                            $sql_id_level = "SELECT * FROM tbl_id_level";
                            $query_id_level = mysqli_query($conn, $sql_id_level);
                            // ค่าที่เลือกในปัจจุบัน
                            $id_level = $user['id_level'];  // assuming 'id_level' column stores the selected value
                            // วนลูปแสดงตัวเลือกใน <select>
                            while ($result_id_level = mysqli_fetch_array($query_id_level)) {
                                $selected_id_level = ($id_level == $result_id_level['id_level']) ? 'selected' : '';  // assuming 'id_level' is the column for IDs
                            ?>
                                <option value="<?php echo htmlspecialchars($result_id_level['id_level']); ?>"
                                    <?php echo $selected_id_level; ?>>
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
                <!-- ปุ่ม Submit ฟอร์ม -->
                <button type="submit" class="btn btn-success btn-block">บันทึก</button>
            </div>
        </div>
    </form>
</section>
<br>
<?php include '../p-inc/footer.php'; ?>
</body>

</html>