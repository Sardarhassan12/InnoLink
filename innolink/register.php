<?php
    include('connect.php');
    include('./classes/userClass.php');

    $passwordError= false;
    $registerError =false;
    if(isset($_POST['registerButton'])){
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $userRole = $_POST['userRole'];

        if(empty($userName) || empty($email) || empty($password) || empty($confirmPassword) || empty($userRole) ){
            
        }
        else{
            
            if($password == $confirmPassword){
                $newUser = new user();
                $registerError = $newUser->registerUser($con,$userName,$password,$email,$userRole);
            }
            else{
                $passwordError = true;
            }
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

    <div class="container">
        <div class="left-panel">
            <img src="./image/main.png" alt="Left Side Image">
        </div>
        <div class="right-panel">
            <div class="login-card">
                <img src="./image/logo.png" alt="Innolink Logo" class="logo"> <br>
                <form action="" method="POST">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" name="userName" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <?php 
                        if($passwordError){
                            echo "<p style='color:red;  text-align:left; font-size:13px;' id='password-error'>Password Doesn't Match !</p>";
                        }
                    ?>
                    

                    <label for="role">User Role</label>
                    <select name="userRole" id="">
                        <option value="Investor" >Investor</option>
                        <option value="Business Owner" >Business Owner</option>
                        <option value="Mentor" >Mentor</option>
                    </select>

                    <button type="submit" class="login-button" name="registerButton">Register</button>
                    <?php 
                        if($registerError){
                            echo "<p style='color:red; text-align:left; font-size:13px; id='register-error'>UserName Already Exists !</p>";
                        }
                    ?>
                    
                </form>
                <a href="./login.php" class="sign-up-link">Already have an account? Login</a>
            </div>
        </div>
    </div>
  <script>
    const passError = document.getElementById("password-error");
    const regError = document.getElementById("register-error");
    if(passError || regError){
        setTimeout(()=>{
            if(passError) passError.style.display = 'none';
            if(regError) regError.style.display='none';
        },5000);
    }
  </script>
</body>
</html>