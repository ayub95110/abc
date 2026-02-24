<!DOCTYPE html>
<html lang="th">
<head>
    <title>ONE | Kapho</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/dental.png" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link href="css/fonts_prompt.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <style>
        body {
            background-color: #e7f1ff; /* สีฟ้าอ่อน */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .message-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .login100-pic img {
            width: 150px; /* กำหนดความกว้างของรูป */
            height: auto; /* ให้ความสูงปรับตามสัดส่วน */
        }
        h1 {
            color: #dc3545; /* สีแดง */
            font-size: 3rem;
        }
        h3 {
            font-size: 1.5rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            font-size: 1.0rem;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <div class="login100-pic js-tilt" data-tilt>
            <img src="img/index.png" alt="IMG">
        </div>
        <h1>ขออภัย !</h1><br>
        <h3>ท่านไม่ได้ใช้งานเป็นเวลานาน</h3><br>
        <h3>กรุณาเข้าสู่ระบบใหม่อีกครั้ง</h3>
        <br><br>
        <a class="btn btn-custom" href="index.php">เข้าสู่ระบบ กด ที่นี้</a>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });
    </script>
    <script src="js/main.js"></script>
</body>
</html>
