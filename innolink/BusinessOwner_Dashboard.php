<?php
    session_start();
    include_once 'connect.php';
    include_once './classes/userClass.php';
    include_once './classes/BusinessOwnerClass.php';
    $error = false;
    $BusinessOwnerObject = null;
    
    if(isset($_SESSION['userName'])){
        $BusinessOwnerObject = new BusinessOwner($_SESSION['userName'],$_SESSION['password'],$_SESSION['email'],$_SESSION['userRole']);
        if(!empty($_SESSION['username'])){
            $BusinessOwnerObject->setName($_SESSION['username']);
        }
        if(!empty($_SESSION['title'])){
            $BusinessOwnerObject->setTitle($_SESSION['title']);
        }
        if(!empty($_SESSION['userImage'])){
            $BusinessOwnerObject->setImage($_SESSION['userImage']);
        }
    
    }
    else{
        echo "fail";
    }
    
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $financial = $_POST['financial'];
        $image = $_FILES['documents'];
        $roi = $_POST['expectedROI'];

        if(empty($title) || empty($desc) || empty($category) || empty($financial) ||empty($image)  ){

        }
        else{
            $imageData = file_get_contents($image['tmp_name']);
            $error = $BusinessOwnerObject->proposeBusinessIdea($con,$title, $desc, $category, $financial, $imageData,  $roi);
        }
    }
    
    if(isset($_POST['update-btn'])){
        $ideaId = $_POST['ideaId'];
        $title = $_POST['updateTitle'];
        $desc = $_POST['updateDescription'];
        $category = $_POST['updateCategory'];
        $financial = $_POST['updateFinance'];
        $image = $_FILES['updateDocuments'];

        if(empty($title) || empty($desc) || empty($category) || empty($financial) ||empty($image)  ){

        }
        else{
            $imageData = file_get_contents($image['tmp_name']);
            $BusinessOwnerObject->updateBusinessIdea($con, $ideaId, $title, $desc, $category, $financial, $imageData);
        }
    }
    // $name =;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Owner Dashboard</title>
    <link rel="stylesheet" href="./css/businessOwner.css">
</head>
<body>
    <header>
        <div class="logo"><img src="./image/logo.png" alt="Innolink Logo" class="logo-img"></div>
        <nav>
            <a href="./BusinessOwner_Dashboard.php">Home</a>
            <a href="./viewAllInvestments.php">Investment History</a>
            <a href="#">Notification</a>
            <a href="#">Messaging</a>
            <a href="./userProfile.php">Profile</a>
            <button class="logout-btn"><a href="./logout.php">Logout</a></button>
        </nav>
    </header>

    <main>
        <aside class="sidebar">
                <div class="profile-picture">  
                    <?php 
                        
                        $encodeImage = base64_encode($BusinessOwnerObject->getImage());
                        echo "<img src='data:image/jpeg;base64,$encodeImage' alt='Profile Picture'>";
                    ?> 
                </div>
                <div class="profile-header-text">
                    <?php
                        echo "
                            <h2>" .$BusinessOwnerObject->getName()."</h2>
                            <p>".$BusinessOwnerObject->getTitle()."</p>
                        ";
                    ?>
                </div>
        </aside>

        <div class="overlay"></div>
        <section class="businessIdeaSection">
            <div class="search-bar">
                <select>
                    <option>Category</option>
                </select>
                <input type="text" placeholder="Search">
                <button class='new-btn'>New</button>
            </div>
            <?php
                if($error){
                    echo '<div class="error-message">
                            <strong>Error!</strong> BusinessOwnerObject is not set.
                            <span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                    </div>';
                }
            ?>
            <div class="cardContainer">
                
                <?php 
                    if ($BusinessOwnerObject !== null) {
                        $BusinessOwnerObject->getAllBusinessIdeas($con);
                        
                    } else {
                        echo "BusinessOwnerObject is not set.";
                    }

                ?>
               
            </div>

            <div class="proposal-container">
                <h1>Submit Your Startup Proposal</h1>
                <form class="proposal-form" method="POST" action="" enctype="multipart/form-data">
                    
                    
                    <h2>Startup Information</h2>
                    
                    <!-- <div class="form-group">
                        <label for="ideaId">Startup ID</label>
                        <input type="text" id="ideaId" name="ideaId" placeholder="Enter your startup ID (unique)" required>
                    </div> -->

                    <div class="form-group">
                        <label for="title">Startup Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter your startup title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe your business model, market need, and potential impact" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Business Category</label>
                        <select id="category" name="category">
                            <option value="tech">Technology</option>
                            <option value="health">Healthcare</option>
                            <option value="finance">Finance</option>
                            <option value="retail">Retail</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    
                    <h2>Financial Requirements</h2>
                    
                    <div class="form-group">
                        <label for="financial">Funding Amount Required ($)</label>
                        <input type="number" id="financial" name="financial" placeholder="Enter the required amount in USD" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="expectedROI">Expected ROI (%)</label>
                        <input type="number" id="expectedROI" name="expectedROI" placeholder="Expected return on investment" >
                    </div>

                    
                    <h2>Upload Supporting Documents</h2>
                    
                    <div class="form-group">
                        <label for="pitchDeck">Pitch Deck (PDF)</label>
                        <input type="file" id="pitchDeck" name="pitchDeck" accept=".pdf" >
                    </div>
                    
                    <div class="form-group">
                        <label for="businessPlan">Business Plan (Optional)</label>
                        <input type="file" id="businessPlan" name="businessPlan" accept=".pdf">
                    </div>
                    
                    <div class="form-group">
                        <label for="media">Upload Images or Videos (jpg, png, mp4)</label>
                        <input type="file" name="documents" accept="image/*" required>
                        </div>

                    
                    <div class="form-actions">
                        <button type="submit" class="submit-btn" name="submit">Submit Proposal</button>
                        <button type="button" class="close-btn">Close Form</button>
                    </div>
                </form>
                
               
        </section>
       
        <section class="communicationSection">
                        
            <div class="chat-container">
                <!-- Sidebar for User List -->
                <div class="cahtSidebar">
                <input type="text" placeholder="Search" class="search-bar">
                <div class="user-list">
                    <div class="user">
                    <img src="https://via.placeholder.com/40" alt="User Icon">
                    <span>User 1</span>
                    </div>
                    <div class="user">
                    <img src="https://via.placeholder.com/40" alt="User Icon">
                    <span>User 1</span>
                    </div>
                    <div class="user">
                    <img src="https://via.placeholder.com/40" alt="User Icon">
                    <span>User 1</span>
                    </div>
                </div>
                </div>
            
                <!-- Chat Area -->
                <div class="chat-area">
                <div class="chat-header">
                    <h2>USER 1</h2>
                </div>
                <div class="chat-messages">
                    <div class="message">Hello, how are you?</div>
                    <div class="message">I wanted to ask about the project update.</div>
                    <div class="message">Let me know if you need anything.</div>
                </div>
                <div class="message-input">
                    <input type="text" placeholder="Type Message">
                    <button class="send-button">
                    <img src="https://via.placeholder.com/20" alt="Send Icon">
                    </button>
                </div>
                </div>
            </div>

        </section>
        
    </main>
    <script>
            const proposalBut = document.querySelector('.new-btn');
            const proposalCard = document.querySelector('.proposal-container');
            const updateCard = document.querySelector('.update-container');
            const overlay = document.querySelector('.overlay');
            const closeBtn = document.querySelector('.close-btn');
            const updateButtons = document.querySelectorAll('.update-btn'); 
            
            proposalBut.addEventListener('click', () => {
                proposalCard.style.display = 'block';
                overlay.style.display = 'block';
            });

            
            closeBtn.addEventListener('click', () => {
                proposalCard.style.display = 'none';
                overlay.style.display = 'none';
            });

            overlay.addEventListener('click', () => {
                proposalCard.style.display = 'none';
                document.querySelectorAll('.update-container').forEach(form => form.style.display = 'none');
                overlay.style.display = 'none';
            });

            updateButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const updateFormId = button.getAttribute('data-form-id'); // Retrieve the unique ID for this form
                    const updateForm = document.getElementById(updateFormId); // Get the form element by ID

                    if (updateForm) {
                        updateForm.style.display = 'block';
                        overlay.style.display = 'block';
                    }
                });
            });
            
    </script>
</body>

</html>
