<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script scr="https://kit.fontawesome.com/c9f5871d83.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>LoGin</title>
    <style>
        .header .search i {
            position: absolute;
            right: 110px;
            top: 22px;
            color: #fff;
        }

        .background {
            width: 100%;
            height: 100vh;
            background-image: url('../images/login.jpg');
            background-position: center;
            background-size: cover;
        }

        .home {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 70%;
            height: 70%;
            transform: translate(-50%, -50%);
            background-image: url('../images/login.jpg');
            background-position: center;
            background-size: cover;
            display: flex;
            margin-top: 10px;
            border: 1px solid black;
            border-radius: 10px;
            border: none;
        }

        .content .icon {
            margin-top: 20px;
            font-size: 1.5cm;
            display: flex;
            justify-content: center;
            color: #fff;
        }

        .content .icon i {
            margin-left: 20px;
            color: #fff;
        }

        .login {
            margin-left: 100px;
            width: 650px;
            position: relative;
            padding: 100px 50px;
            backdrop-filter: blur(20px);
        }

        .login h2 {
            font-size: 1.5cm;
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .login .input {
            position: relative;
            width: 100%;
            height: 40px;
            margin-bottom: 40px;
        }

        .check a {
            text-decoration: none;
            color: #fff;
        }

        .check a:hover {
            text-decoration: underline;
        }

        .login .button {
            width: 100%;
            height: 40px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            height: 40px;
            background-color: crimson;
            border: none;
            outline: none;
            font-size: 20px;
            font-weight: 700;
            border-radius: 7px;
            color: #fff;
        }

        button:active {
            font-size: 25px;
        }

        .content {
            display: flex;
            flex-direction: column;
            width: 700px;
            padding: 100px 0;

        }

        .content a {
            position: relative;
            text-decoration: none;
            color: #fff;
            font-size: 1.5cm;
            font-weight: 700;
            top: -40px;
            left: 80px;
        }

        .content h2 {
            font-size: 2cm;
            text-align: center;
            color: #fff;
        }

        .content h3 {
            font-size: 0.5cm;
            text-align: center;
            color: #fff;
        }

        .content pre {
            margin-top: 20px;
            text-align: center;
            font-size: 1cm;
            color: #fff
        }

        .login .input .input1 {
            font-size: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: 2px solid #fff;
            color: #fff;
            width: 100%;
            height: 100%;
        }

        ::placeholder {
            color: #fff;
            font-size: 18px;
        }

        .login .input i {
            position: relative;
            right: -370px;
            bottom: 27px;
            color: #fff;
        }

        .check {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            color: #fff;
        }


        .login .sign-up {
            display: flex;
            justify-content: center;
        }

        .login .sign-up a {
            text-decoration: none;
            color: #fff;
            font-weight: 700;
        }

        .login .sign-up p {
            color: #fff;
        }

        .sign-up a:hover {
            text-decoration: underline;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .message{
            color: #fff;
          text-align: center;
           
        }
        .name1{
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="background"></div>
    <section class="home">
        <div class="content">
            <a href="#" class="logo">NLD-MARKET</a>
            <h2>Xin Chào!</h2>
            <h3>Hãy Đăng Nhập Vào Hệ Thống</h3>
            <br>
            <br>
            <br>
            <br>
            <h3>Để đăng nhập, nhập thông tin tài khoản và mật khẩu của bạn.</h3>
            <div class="icon">
                <i class="fa-brands fa-instagram"></i>
                <i class="fab fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-github"></i>
            </div>
        </div>
        <div class="login">
            <h2>Đăng Nhập</h2>
            <form class="form-horizontal" name="useradmin" action="{{ route('admin.postLogin') }}" method="POST">
                @csrf
                @method('post')
                <div class="input">
                    <h3 class="name1">Tài Khoản</h3>
                    <input type="text" class="input1" name="username" placeholder="Email" required>
                    
                </div>
                <div class="input">
                    <h3  class="name1">Mật Khẩu</h3>
                    <input type="password"class="input1"name="password" placeholder="Password" required>
                    
                </div>
                <div class="check">
                    <label><input type="checkbox">Nhớ Mật Khẩu</label>
                    <a href="#" class="btn">Quên Mật Khẩu?</a>
                </div>
                <div class="button">
                    <button class="btn">Đăng Nhập</button>
                    
                </div>
                <br>
                <div class="sign-up">
                    <p>Bạn chưa có tài khoản?</p>
                    <a href="#">Đăng Kí</a>
                </div>
                <br>
                <br>
                <div class="message">
                     <h3> @isset($error)
                        <div class="texter">{{ $error }}</div>
                    @endisset
                    </h3>
                </div>
            </form>
        </div>


    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
