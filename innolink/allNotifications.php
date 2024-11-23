<?php
    // echo "Investor";
    session_start();

    include_once './connect.php';
    include_once './classes/InvestorClass.php';
    include_once './classes/BusinessOwnerClass.php';
    include_once './classes/Notification.php'; 

    $investor = null;
    $businessOwner = null;

    if(isset($_SESSION['userName'])){
        if($_SESSION['userRole'] === "Investor"){
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
            $notifications = Notification::getNotifications($con, $_SESSION['userName']);
        }

        elseif($_SESSION['userRole'] === "Business Owner"){
            // echo "PASS";
            $businessOwner = new BusinessOwner($_SESSION['userName'],$_SESSION['password'],$_SESSION['email'],$_SESSION['userRole']);
            if(!empty($_SESSION['username'])){
                $businessOwner->setName($_SESSION['username']);
            }
            if(!empty($_SESSION['title'])){
                $businessOwner->setTitle($_SESSION['title']);
            }
            if(!empty($_SESSION['userImage'])){
                $businessOwner->setImage($_SESSION['userImage']);
            }
            $_SESSION['businessOwner'] = serialize($businessOwner);
            $notifications = Notification::getNotifications($con,  $_SESSION['userName']);
        }
    }else{
        echo "fail";
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Proposals</title>
    <link rel="stylesheet" href="./css/notification.css">
</head>
<body>
<header>
    <div class="logo"><img src="./image/logo.png" alt="Innolink Logo" class="logo-img"></div>
        <?php
        if($investor != null){
            echo '
            <nav>
                <a href="./Investor_Dashboard.php">Home</a>
                <a href="./viewAllInvestments.php">Investmets</a>
                <a href="./allNotifications.php">Notification</a>
                <a href="#">Messaging</a>
                <a href="./userProfile.php">Profile</a>
                <button class="logout-btn"><a href="./logout.php">Logout</a></button>
            </nav>';
        }elseif($businessOwner != null){
            echo '
            <nav>
                <a href="./BusinessOwner_Dashboard.php">Home</a>
                <a href="./viewAllInvestments.php">Investment History</a>
                <a href="#">Notification</a>
                <a href="#">Messaging</a>
                <a href="./userProfile.php">Profile</a>
                <button class="logout-btn"><a href="./logout.php">Logout</a></button>
            </nav>';
        }   
        ?>
    
    </header>

    <main>
        <aside class="sidebar">
            <div class="profile-picture">  
                
                <?php 
                if($investor != null){
                    $encodeImage = base64_encode($investor->getImage());
                    echo "<img src='data:image/jpeg;base64,$encodeImage' alt='Profile Picture'>";
                }elseif($businessOwner != null){
                    $encodeImage = base64_encode($businessOwner->getImage());
                    echo "<img src='data:image/jpeg;base64,$encodeImage' alt='Profile Picture'>";
                }
                    
                ?>

            </div>
            <div class="profile-header-text">
                
                <?php
                if($investor != null){
                    echo "
                        <h2>" .$investor->getName()."</h2>
                        <p>".$investor->getTitle()."</p>
                    ";
                }elseif($businessOwner != null){
                    echo "
                        <h2>" .$businessOwner->getName()."</h2>
                        <p>".$businessOwner->getTitle()."</p>
                    ";
                }
                   
                ?>
                
            </div>
        </aside>
        <div class="notification-container">
            <h2>Notifications</h2>
            <?php
            if (count($notifications) > 0) {
                foreach ($notifications as $notification) {
                    echo '
                    <div class="notification-item">
                        <div class="notification-text">
                            <p>' . $notification['message'] . '</p>
                            <span class="notification-time">' . $notification['created_at'] . '</span>
                        </div>
                        <a href="?markRead=' . $notification['notificationId'] . '" class="mark-read">Mark as Read</a>  
                    </div>';
                }
            }
            ?>
        </div>
            
    <div>

    </div>
    <?php
        if (isset($_GET['markRead'])) {
            $notificationId = $_GET['markRead'];
            Notification::markAsRead($con, $notificationId);
        }
    ?>
</body>
</html>
