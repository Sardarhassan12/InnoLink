<?php
    
    include_once('userClass.php');
    include('investmentHistory.php');

    class Investor extends user{
        
        public function __construct( $userName, $password, $email, $userRole){
            $this->userName = $userName;
            $this->password = $password;
            $this->email = $email;
            $this->userRole = $userRole;
        }

        public function getAllBusinessIdeas($con){
            $query = "select * from businessidea";
            $result = mysqli_query($con, $query);
            if($result){
                while($row = mysqli_fetch_assoc($result)){

                    $ideaId = $row['ideaId'];
                    $checkInvestmentQuery = "SELECT * FROM investmentproposal WHERE investor = '$this->userName' AND businessideaId = '$ideaId'";
                    $checkResult = mysqli_query($con, $checkInvestmentQuery);
        
                    
                    if (mysqli_num_rows($checkResult) > 0) {
                        $buttonText = "Bidded";
                        $buttonClass = "bidded-btn";  
                    } else {
                        $buttonText = "Bid";
                        $buttonClass = "bid-btn";  
                    }

                    echo "<div class='project'>
                            <div class='project-details'>
                                <h2>".$row['title']."</h2>
                                <p>".$row['description']."</p>
                                <p>Total Investment : ".$row['finance']."  -/Rs</p>
                                <p>ROI (%) :20%</p>
                            </div>
                            <button class='$buttonClass'><a href='./Investment_Proposal.php?id=".$row['ideaId']."' style='text-decoration = 'none'';>$buttonText</a></button>
                        </div>";
                }
            }
        }
         
        public function proposeInvestment($con,  $investmentType, $investmentAmount, $id, $investor){
           
            $query2 = "insert into investmentproposal ( amount, investor, businessideaId, investmentType) VALUES ('$investmentAmount','$this->userName','$id',' $investmentType' )";
            $result2= mysqli_query($con, $query2);

            if($result2){
                return "submitted";
            }

        }

        public function displayAllProposals($con){
            $investments = new InvestmentHistory();
            $investments->setHistoryId($this);
            $investments->addProposals($con);
            $investments->getInvestmentDetails();
        }
        
    }

?>