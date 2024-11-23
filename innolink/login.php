<?php
    include('connect.php');
    include('./classes/userClass.php');
    $error= false;
    // try{
        if(isset($_POST['loginButton'])){
            $userName = $_POST['username'];
            $password = $_POST['password'];
            
            $existingUser = new User();
            $error = $existingUser->login($con, $userName, $password);
        }
    // }
    // catch{

    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="./image/logo.png" alt="Left Side Image">
        </div>
        <div class="right-panel">
            <div class="login-card">
                <!-- <img src="/img/logo.png" alt="Innolink Logo" class="logo"> <br>-->
                <h1>Login</h1>
                <form action="" method="POST">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <?php 
                        if($error){
                            echo "<p style='color:red;  text-align:left; font-size:10px;' id='error'>User Not Found</p>";
                        }
                    ?>

                    <a href="#" class="forgot-password">Forget Password?</a>

                    <button type="submit" class="login-button" name="loginButton">Login</button>
                    <button type="button" class="google-button">Sign In With Google</button>
                </form>
                <a href="./register.php" class="sign-up-link">Sign Up</a>
            </div>
        </div>
    </div>
    <script>
        const error = document.getElementById("error");
        
        if(error){
            setTimeout(()=>{
                if(error) error.style.display = 'none';
            },5000);
        }
    </script>
</body>
</html>
