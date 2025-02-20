<?php
include_once('userClass.php');
include_once('BusinessIdeaClass.php');
// include_once('investmentHistory.php');

    class BusinessOwner extends user{
        
        private $businessIdeas = [];

        public function __construct( $userName, $password, $email, $userRole){
           $this->userName = $userName;
           $this->password = $password;
           $this->email = $email;
           $this->userRole = $userRole;
        }
        
        public function proposeBusinessIdea($con,$title, $desc, $category, $financial, $image, $roi){
                    

                    $escapedImage = addslashes($image);
                    $query2 = "insert into businessidea (title, description, category, finance,expectedROI, image, BusinessOwnerUserName) VALUES ('$title',' $desc','$category',' $financial', '$roi','$escapedImage','$this->userName' )";
                    $result2= mysqli_query($con, $query2);
        
                    if($result2){
                        return true;
                    }

        }

        public function getAllBusinessIdeas($con){
                
                $query = "select * from businessidea where BusinessOwnerUserName = '$this->userName' ";
                $result = mysqli_query($con, $query);
                
                if($result){
                    while($data =  mysqli_fetch_assoc($result)){

                        $businessIdeas = new BusinessIdea($this, $data['ideaId'],$data['title'], $data['description'],$data['category'],$data['finance'], $data['image']);
                        $this->businessIdeas[] = $businessIdeas;

                    }
                }
                
                foreach($this->businessIdeas as $businessIdea){
                    $updateFormId = 'update-form-' . $businessIdea->getIdeaId();
                    $deleteFormId = 'delete-form-' . $businessIdea->getIdeaId();
                    $encodedImage = base64_encode($businessIdea->getImage());
                    echo "<div class='idea-card'>
                            <div class='card-image'>
                            
                            <img src='data:image/jpeg;base64,$encodedImage' alt='Business Idea Image'>
                            </div>
                            <div class='card-header'>
                            <h2 class='idea-name'>".htmlspecialchars($businessIdea->getTitle())."</h2>
                            <p class='idea-desc'>".htmlspecialchars($businessIdea->getDescription())."</p>
                            </div>
                            <div class='card-body'>
                            <div class='info'>
                                <p><strong>Bids Placed:</strong> 8</p>
                                <p><strong>Total Investment:</strong> ".htmlspecialchars($businessIdea->getFinance())."</p>
                                <p><strong>Stage:</strong> <span class='investment-stage'>Seed</span></p>
                            </div>
                            <div class='card-actions'>
                                <button class='update-btn' data-form-id='$updateFormId'>Update</button>
                                <button class='delete-btn' data-form-id='$deleteFormId'>Delete</button>
                            </div>
                            </div>
                        </div>
                        

                        <div class='update-container' id='$updateFormId' >
                        <h1>Submit Your Startup Proposal</h1>
                        <form class='proposal-form' method='POST' action='' enctype='multipart/form-data'>
                            <h2>Startup Information</h2>
    
                            <div class='form-group'>
                                <label for='ideaId'>Startup ID</label>
                                <input type='text' id='ideaId' name='ideaId' placeholder='".htmlspecialchars($businessIdea->getideaId())."' value='".htmlspecialchars($businessIdea->getideaId())."'required readonly>
                            </div>
    
                            <div class='form-group'>
                                <label for='title'>Startup Title</label>
                                <input type='text' id='title' name='updateTitle' placeholder='".htmlspecialchars($businessIdea->getTitle())."' value='".htmlspecialchars($businessIdea->getTitle())."'required>
                            </div>
    
                            <div class='form-group'>
                                <label for='description'>Description</label>
                                <textarea id='description' name='updateDescription' placeholder='".htmlspecialchars($businessIdea->getDescription())."' value='".htmlspecialchars($businessIdea->getDescription())."'required></textarea>
                            </div>
    
                            <div class='form-group'>
                                <label for='category'>Business Category</label>
                                <select id='category' name='updateCategory'>
                                    <option value='tech'>Technology</option>
                                    <option value='health'>Healthcare</option>
                                    <option value='finance'>Finance</option>
                                    <option value='retail'>Retail</option>
                                    <option value='other'>Other</option>
                                </select>
                            </div>
    
                            <h2>Financial Requirements</h2>
    
                            <div class='form-group'>
                                <label for='financial'>Funding Amount Required ($)</label>
                                <input type='number' id='financial' name='updateFinance' placeholder='".htmlspecialchars($businessIdea->getFinance())."'  value='".htmlspecialchars($businessIdea->getFinance())."'required>
                            </div>
    
                            <div class='form-group'>
                                <label for='expectedROI'>Expected ROI (%)</label>
                                <input type='number' id='expectedROI' name='expectedROI' placeholder='Expected return on investment' required>
                            </div>
    
                            <h2>Upload Supporting Documents</h2>
    
                            <div class='form-group'>
                                <label for='pitchDeck'>Pitch Deck (PDF)</label>
                                <input type='file' id='pitchDeck' name='pitchDeck' accept='.pdf'>
                            </div>
    
                            <div class='form-group'>
                                <label for='businessPlan'>Business Plan (Optional)</label>
                                <input type='file' id='businessPlan' name='businessPlan' accept='.pdf'>
                            </div>
    
                            <div class='form-group'>
                                <label for='media'>Upload Images or Videos (jpg, png, mp4)</label>
                                <input type='file' id='media' name='updateDocuments' accept='image/*' multiple>
                            </div>
    
                            <div class='form-actions'>
                                <button type='submit' class='update-btn-1' name='update-btn'>Update Proposal</button>
                                <button type='button' class='close-btn' id='old-close-btn'>Close Form</button>
                            </div>
                        </form>
                    </div>"
                        ;
                    }
                return $this->businessIdeas;
        }

      
        
        public function updateBusinessIdea($con, $ideaId,$title, $desc, $category, $financial, $image){
            $escapedImage = addslashes($image);
            $query = "UPDATE businessidea SET title = '$title', description = '$desc', category = '$category', finance = '$financial', image = '$escapedImage' Where ideaId = '$ideaId'";
            $result= mysqli_query($con, $query);

        }

        public function viewIdeaInvestment($con){
            $investment = new InvestmentHistory();
            $investment->getAllBusinessIdeasInvestment($con);
        }

    }
?>