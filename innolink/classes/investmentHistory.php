<?php

    include_once 'InvestmentProposalClass.php';
    include_once 'BusinessIdeaClass.php';
    
    class InvestmentHistory{
        private $historyId;
        private $investmentProposals = [];
        
        public function setHistoryId(Investor $investor) {
            $this->historyId = $investor;
        }
    

        public function addProposals($con) {
            $userName = $this->historyId->getUserName();
            $query = "SELECT * FROM investmentproposal WHERE investor = '$userName'";
            $result = mysqli_query($con, $query);
        
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    $ideaID = $data['businessideaId'];
                    $qu = "SELECT * FROM businessidea WHERE ideaId = '$ideaID'";
                    $res = mysqli_query($con, $qu);
        
                    if ($row = mysqli_fetch_assoc($res)) {
                        $ownerName = $row['BusinessOwnerUserName'];
                        $ownerQuery = "SELECT * FROM user_info WHERE userName = '$ownerName'";
                        $ownerResult = mysqli_query($con, $ownerQuery);
        
                        if ($ownerData = mysqli_fetch_assoc($ownerResult)) {
                            $businessOwner = new BusinessOwner($ownerData['userName'], $ownerData['password'], $ownerData['email'], $ownerData['userRole']);
                            $businessIdea = new BusinessIdea($businessOwner, $row['ideaId'], $row['title'], $row['description'], $row['category'], $row['finance'], $row['image']);
        
                            $investments = new InvestmentProposal($data['proposalId'], $data['investmentType'], $data['amount'], $this->historyId, $businessIdea, $data['status']);
                            $this->investmentProposals[] = $investments; 
                        }
                    }
                }
            } else {
                echo "No proposals found for this user.";
            }
        }

        public function getInvestmentDetails(){
            echo "<table class='proposal-table'>";
            echo "<thead>
                    <tr>
                        <th>Proposal ID</th>
                        <th>Amount</th>
                        <th>Investor</th>
                        <th>Business Idea ID</th>
                        <th>Investment Type</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
    
            
            foreach ($this->investmentProposals as $proposal) {
                
                echo "<tr>
                        <td>{$proposal->getinvestmentId()}</td>
                        <td>{$proposal->getinvestmentAmount()}</td>
                        <td>{$this->historyId->getUserName()}</td>
                        <td>{$proposal->getBusinessIdea()->getIdeaId()}</td>
                        <td>{$proposal->getinvestmentType()}</td>
                        <td>{$proposal->getInvestmentStatus()}</td>
                        <td>";{if($proposal->getInvestmentStatus() === 'pending'){echo "<button>Withdraw</button>";}};echo "</td>
                      </tr>";
            }
    
            echo "</tbody></table>";  
        }

        public function getAllBusinessIdeasInvestment($con){

            //samajhna ha isko
            
            $query = "SELECT ui.userName AS businessOwner, bi.ideaId, bi.title, bi.finance, ip.proposalId, ip.amount, ip.investor, ip.status
            FROM
                user_info ui
            JOIN
                businessidea bi ON ui.userName = bi.BusinessOwnerUserName
            LEFT JOIN
                investmentproposal ip ON bi.ideaId = ip.businessideaId
            WHERE
                ui.userRole = 'Business Owner'
            ORDER BY
                bi.ideaId, ip.proposalId";

            $result = mysqli_query($con, $query);

            if($result){
                echo "<table class='proposal-table'>";
                echo "<thead>
                        <tr>
                            <th>Business Idea ID</th>
                            <th>Business Idea Title</th>
                            <th>Total Propose Investment</th>
                            <th>Investor</th>
                            <th>Amount</th>
                            <th>Option</th>
                        </tr>
                        </thead>";
                echo "<tbody>";

                while($row = mysqli_fetch_assoc($result)){

                    $status = ucfirst($row['status']); 
                    $button = "";

                    if($status === 'Pending'){
                        $button = "<form method='POST' action=''>
                                    <input type='hidden' name='proposalId' value='{$row['proposalId']}'>
                                    <input type='hidden' name='ideaId' value='{$row['ideaId']}'>
                                    <button type='submit' name='acceptProposal' class='accept-btn'>Accept</button>
                                </form>";
                    } elseif($status === 'Accepted'){
                        $button = "<button class='accepted-btn' disabled>Proceeded</button>";
                    } else {
                        $button = "<button class='rejected-btn' disabled>Rejected</button>";
                    }

                    echo "<tr>
                            <td>{$row['ideaId']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['finance']}</td>
                            <td>{$row['investor']}</td>
                            <td>{$row['amount']}</td>
                            <td>$button</td>
                            </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>No investment proposals found.</p>";
            }
        }
    }
?>