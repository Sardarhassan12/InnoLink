<?php
    // echo "Investor";
    session_start();
    include_once 'connect.php';
    include_once './classes/InvestorClass.php';
    
    $investor = null;
    
    if(isset($_SESSION['userName'])){
        $investor = new Investor($_SESSION['userName'],$_SESSION['password'],$_SESSION['email'],$_SESSION['userRole']);
        if(!empty($_SESSION['username'])){
            $investor->setName($_SESSION['username']);
        }
        if(!empty($_SESSION['title'])){
            $investor->setTitle($_SESSION['title']);
        }
        if(!empty($_SESSION['userImage'])){
            $investor->setImage($_SESSION['userImage']);
        }
        
        $_SESSION['investor'] = serialize($investor);
    }else{
        echo "fail";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Dashboard</title>
    <link rel="stylesheet" href="./css/investor.css">
</head>
<body>
    <header>
        <div class="logo"><img src="./image/logo.png" alt="Innolink Logo" class="logo-img"></div>
        <nav>
            <a href="./Investor_Dashboard.php">Home</a>
            <a href="./viewAllInvestments.php">Investmets</a>
            <a href="./allNotifications.php">Notification</a>
            <a href="#">Messaging</a>
            <a href="./userProfile.php">Profile</a>
            <button class="logout-btn"><a href="./logout.php">Logout</a></button>
        </nav>
    </header>

    <main>
        <aside class="sidebar">
                <div class="profile-picture">  
                    <?php 
                        
                        $encodeImage = base64_encode($investor->getImage());
                        echo "<img src='data:image/jpeg;base64,$encodeImage' alt='Profile Picture'>";
                    ?> 
                </div>
                <div class="profile-header-text">
                    <?php
                        echo "
                            <h2>" .$investor->getName()."</h2>
                            <p>".$investor->getTitle()."</p>
                        ";
                    ?>
                </div>
        </aside>

        <section class="content">
            

            <div class="search-bar">
                <select>
                    <option>Category</option>
                </select>
                <input type="text" placeholder="Search">
            </div>

            <div class="project-list">
                <?php
                    $investor->getAllBusinessIdeas($con);  
                ?>
            </div>
        </section>
                
    </main>
</body>
</html>