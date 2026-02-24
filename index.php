<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> ONE KPH </title>

    <link rel="icon" type="image/png" href="img/main.png" />

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-login100 {
            position: relative;
            width: 100%;
            max-width: 420px;
            padding: 20px;
            z-index: 2;
        }

        .wrap-login100 {
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3), 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }



        .login100-form-title {

            display: block;

            font-size: 24px;

            font-weight: 500;

            color: #333;

            line-height: 1.5;

            text-align: center;

            margin-bottom: 40px;

        }



        .wrap-input100 {

            position: relative;

            margin-bottom: 25px;

        }



        .input100 {

            width: 85%;

            height: 45px;

            background: #ffffff;

            border: 1px solid #ddd;

            border-radius: 25px;
            /* Make corners round */

            padding: 0 20px;
            /* Increase horizontal padding */

            font-size: 15px;

            color: #333;

            font-family: 'Kanit', sans-serif;

            transition: all 0.3s ease;

            display: block;

            margin: 0 auto;
            /* Center the input field */

        }



        .input100:focus {

            border-color: #4267B2;

            outline: none;

            box-shadow: 0 0 0 2px rgba(66, 103, 178, 0.1);
            /* Add subtle focus shadow */

        }



        .login100-form-btn {

            width: 100%;

            height: 45px;

            background: #449948ff;

            border-radius: 25px;
            /* Match input field roundness */

            border: none;

            color: #fff;

            font-size: 16px;

            font-weight: 500;

            font-family: 'Kanit', sans-serif;

            cursor: pointer;

            transition: all 0.3s ease;

        }



        .login100-form-btn:hover {

            background: #00ac09ff;

        }



        @media (max-width: 480px) {

            .container-login100 {

                padding: 10px;

            }



            .wrap-login100 {

                padding: 30px 20px;

            }

        }
    </style>

</head>

<body>

    <div class="container-login100">

        <div class="wrap-login100">

            <form class="login100-form validate-form" action="check-login.php" method="post">

                <span class="login100-form-title">
                    WELCOME <br>
                    - A B C -
                </span>

                <div class="wrap-input100">

                    <input class="input100" type="text" name="username" placeholder="Username" required>

                </div>

                <div class="wrap-input100">

                    <input class="input100" type="password" name="password" placeholder="Password" required>

                </div>

                <button class="login100-form-btn">

                    เข้าสู่ระบบ

                </button>

            </form>

        </div>

    </div>

</body>

</html>