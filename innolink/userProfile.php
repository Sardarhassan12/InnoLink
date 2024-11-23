<?php
    session_start();
    include_once 'connect.php';
    include_once './classes/userClass.php';
    include_once './classes/BusinessOwnerClass.php';

    $user = null;
    $name = null;
    $title = null;
    $userName = null;
    $password = null;
    $email = null;
    $image = null;
    $userRole = null;
    try{
        
        if(isset($_SESSION['userName'])){
            
            $user = new user();
            $userName = $_SESSION['userName'];
            $email = $_SESSION['email'];
            $image = base64_encode($_SESSION['userImage']);
            $password= $_SESSION['password'];
            $name = $_SESSION['username'];
            $title = $_SESSION['title'];
            $userRole = $_SESSION['userRole'];
        }
        else{
            // echo "fail";
        }

        if(isset($_POST['submit'])){
            if(empty($_POST['userName']) || empty($_POST['email']) ){
                // echo "pass1";
            }
            else{
                // echo "pass3";
                $image = $_FILES['image'];
                // $image_data = file_get_contents($image['tmp_name']);
                if (!empty($image['tmp_name']) && file_exists($image['tmp_name'])) {
                    
                    $image_data = file_get_contents($image['tmp_name']);
                    $user->updateAccount($con, $_POST['userName'], $_POST['email'], $_POST['title'], $_POST['name'], $image_data);
                
                } else {
                    echo "Invalid file upload. Please upload a valid image.";
                }
                // $user->updateAccount($con, $_POST['userName'], $_POST['email'],$_POST['title'] ,$_POST['name'],$image_data);
            }
            

        }
    }catch(Exception $ecx){
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="./css/userProfile.css">
</head>
<body>
    <header>
        <div class='logo'><img src='./image/logo.png' alt='Innolink Logo' class='logo-img'></div>
        
            <?php

            if($userRole === "Business Owner"){
            echo '  
                <nav>
                    <a href="./BusinessOwner_Dashboard.php">Home</a>
                    <a href="./viewAllInvestments.php">Investment History</a>
                    <a href="#">Notification</a>
                    <a href="#">Messaging</a>
                    <a href="./userProfile.php">Profile</a>
                    <button class="logout-btn"><a href="./logout.php">Logout</a></button>
                </nav>';
            }else if($userRole === "Investor"){
             echo '  
                <nav>
                    <a href="./Investor_Dashboard.php">Home</a>
                    <a href="./viewAllInvestments.php">Investmets</a>
                    <a href="./allNotifications.php">Notification</a>
                    <a href="#">Messaging</a>
                    <a href="./userProfile.php">Profile</a>
                    <button class="logout-btn"><a href="./logout.php">Logout</a></button>
                </nav>
            ';
            }

        ?>
            
    </header>
    <main>
        

        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-picture">  
                    <?php
                        echo "<img src='data:image/jpeg;base64,$image' alt='Profile Picture'>";
                    ?> 
                    
                </div>
                <div class="profile-header-text">
                    <?php
                        echo "
                            <h2>$name</h2>
                            <p>$title</p>
                        ";
                    ?>
                </div>
                <div class="camera-button">📷</div>
            </div>

            <div class="form-container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <?php echo" <input type='text' id='name' name='name' value='".($name ? $name:'Not Mention' )."' required>"
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <?php echo" <input type='text' id='title' name='title' value='".($title ? $title:'Not Mention' )."' required>"
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="username">User Name</label>
                        <?php echo" <input type='text' id='username' placeholder='$userName' value='$userName' name='userName' required>"
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <?php echo" <input type='text' id='username' placeholder='$email' value='$email' name='email' required>"
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="userRole">User Role</label>
                        <?php echo" <input type='text' id='userRole' placeholder='$userRole'  value='$userRole' name='userRole' required>"
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">User Image</label>
                        <?php echo" <input type='File' id='image' name='image' accept='image/*' >"
                        ?>
                    </div>

                    <div class="form-group actions">
                        <button type="button">Delete</button>
                        <button type="submit" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
