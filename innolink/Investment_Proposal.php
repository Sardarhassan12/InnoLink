<?php
    session_start();
    include 'connect.php';
    include_once('./classes/InvestorClass.php');
    $message = null;
    $result = null;
    $row = null;
    $investor = null;

    if (isset($_SESSION['investor'])) {
        $investor = unserialize($_SESSION['investor']);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM businessidea WHERE ideaId = $id";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        }
    }

    if (isset($_POST['submit'])) {
        // $investmentId = $_POST['investmentId'];
        $investmentType = $_POST['investmentType'];
        $investmentAmount = $_POST['investmentAmount'];

        if (empty($investmentType) || empty($investmentAmount)) {
            $message = "Please fill out all fields.";
        } else if ($row['finance'] >= $investmentAmount) {
            $message = $investor->proposeInvestment($con, $investmentType, $investmentAmount, $id, $investor);
        } else {
            $message = "investment"; 
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Proposal - Innolink</title>
    <link rel="stylesheet" href="./css/Investment_Proposal.css">
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

        
        <div class="container">
            
            <div class="step active">
                <?php 
                    if ($row) {
                        echo "<h1>" . htmlspecialchars($row['title']) . "</h1>
                            <p class='tagline'>" . htmlspecialchars($row['description']) . "</p>";
                    } else {
                        echo "<h1>No Business Idea Found</h1>
                            <p class='tagline'>Please ensure a valid business idea ID is provided.</p>";
                    }
                ?>    
                <div class="info-box">
                    <?php 
                        if ($row) {
                            echo "<strong>Funding Goal:</strong> $" . htmlspecialchars($row['finance']) . "<br>";
                        } else {
                            echo "<strong>Funding Goal:</strong> Not Available<br>";
                        }
                    ?> 
                    <p class="info-box-part"></p>
                    <strong >Mission:</strong> Revolutionizing renewable energy through innovative technology.
                </div>
                <button class="toggle-details">Learn More</button>
            </div>

            <div>
                <?php
                    if ($message === "notsubmitted") {
                        echo '<div class="error-message">
                                <strong>Error!</strong> Investment ID Already Exists.
                                <span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                            </div>';
                    } elseif ($message === "submitted") {
                        echo '<div class="success-message">
                                <strong>Success!</strong> Proposal Submitted.
                                <span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                            </div>';
                    } elseif ($message === "investment") {
                        echo '<div class="error-message">
                                <strong>Error!</strong> Investment Must Be Less than $' . htmlspecialchars($row['finance']) . '.
                                <span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                            </div>';
                    } elseif ($message) {
                        echo '<div class="error-message">
                                <strong>Error!</strong> ' . htmlspecialchars($message) . '
                                <span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                            </div>';
                    }
                ?>
            </div>


            <div class="step">
                <h2>ROI Calculator</h2>
                <label for="investment">Enter Investment Amount ($):</label>
                <input type="range" id="investment" min="1000" max="50000" step="1000" value="10000" oninput="updateROI(this.value)">
                <p>Investment: $<span id="investmentAmount">10000</span></p>
                <p>Expected Annual Return: <span id="annualReturn">8%</span></p>
                <p>Total Potential Return: <span id="totalReturn">$10800</span></p>
            </div>

            <div class="step">
                <h2>Choose Your Investment Type</h2>
                <div class="investment-options">
                    <div class="option-card" onclick="selectOption(this, 'Equity Stake')">
                        <h3>Equity Stake</h3>
                        <p>Own a share of the company with potential for growth.</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'Loan')">
                        <h3>Loan</h3>
                        <p>Fixed return on investment with interest.</p>
                    </div>
                    <div class="option-card" onclick="selectOption(this, 'Revenue Share')">
                        <h3>Revenue Share</h3>
                        <p>Earn a percentage of company revenue.</p>
                    </div>
                </div>
            </div>

            <div class="step">
               
                <h2>Submit Your Proposal</h2>
                <form action="" method="post">
                    <!-- <label for="investmentId">Investment Id:</label>
                    <input type="number" id="investmentId" name="investmentId" required> -->
                    <label for="investmentType">Investment Type:</label>
                    <input type="text" id="investmentType" name="investmentType" readonly value="Equity Stake" required>
                    <label for="investmentAmount">Investment Amount ($):</label>
                    <input type="number" id="investmentAmount" name="investmentAmount" min="1000" required>
                    <label for="terms">Terms and Conditions:</label>
                    <textarea id="terms" rows="4" readonly>By submitting this proposal, you agree to the terms and conditions...</textarea>
                    <button type="submit" name="submit">Submit Proposal</button>
                </form>
            </div>

            <div class="buttons">
                <button id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
    </main>
    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".step");

        function showStep(n) {
            steps.forEach((step, index) => {
                step.classList.toggle("active", index === n);
            });
            document.getElementById("prevBtn").style.display = n === 0 ? "none" : "inline";
            document.getElementById("nextBtn").textContent = n === steps.length - 1 ? "Submit" : "Next";
        }

        function nextPrev(n) {
            currentStep += n;
            if (currentStep >= steps.length) {
                alert("Proposal Submitted!");
                currentStep = steps.length - 1;
                return false;
            }
            showStep(currentStep);
        }

        showStep(currentStep);

        function updateROI(value) {
            document.getElementById('investmentAmount').textContent = value;
            const annualReturn = Math.round(value * 0.08);
            document.getElementById('totalReturn').textContent = `$${parseInt(value) + annualReturn}`;
        }


        function selectOption(element, option) {
            document.querySelectorAll('.option-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('investmentType').value = option;
        }
    </script>
</body>
</html>
