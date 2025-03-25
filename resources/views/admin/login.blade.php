<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('assets\admin\login\style.css')}}">
</head>
<body>
    <section class="container">

        <div class="login-container">
            @include('admin.message')
            
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form action="{{route('admin.authenticate')}}" method="post">
                    @csrf
                    <input type="text" name="email" placeholder="ENTER EMAIL" value="{{old('email')}}"/>
                    <input type="password" name="password" placeholder="PASSWORD" />
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
              
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

<script src="{{asset('assets\admin\login\custome.js')}}"></script>
</html>