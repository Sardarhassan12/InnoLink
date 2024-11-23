<?php
   
    class user{
        protected $userName;
        protected $password;
        protected $email;
        protected $userRole;
        protected $image;
        protected $name;
        protected $title;
        private $hashPassword;

        public function __construct(){
        
        }

        public function registerUser($con, $userName, $password, $email, $userRole){
            try{
               
                $query1 = "Select * from user_info where userName='$userName'";
                $result= mysqli_query($con, $query1);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    echo $row['userName'];
                    return true;
                }
                else{
                    $hashPassword =password_hash($password, PASSWORD_DEFAULT);
                    $query2 = "Insert into user_info (userName,email,password,userRole) values('$userName','$email','$hashPassword','$userRole')";
                    $innerresult= mysqli_query($con, $query2);
                    
                    if(!$innerresult){
                        return true;
                    }
                    else{
                        echo "<script>alert('user register successfully');</script>";
                        return false;
                    }
                }
                
            }
           catch(Exception $e) {
                error_log($e->getMessage());
                
            }

        }

        public function login($con, $userName, $password){
            $query = "Select * from user_info where userName = '$userName'";
            $result = mysqli_query($con, $query);
            
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $hashPassword = $row['password'];

                if(password_verify($password, $hashPassword)){
                    if($row['userRole'] == "Business Owner"){
                        
                        session_start();
    
                        $_SESSION['userName'] = $row['userName'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['userRole'] = $row['userRole'];
                        $_SESSION['userImage'] = $row['userImage'];
                        $_SESSION['username'] =$row['name'] ;
                        $_SESSION['title'] = $row['title'];

                        header("location: BusinessOwner_Dashboard.php");

                        exit();

                    }
                    else if($row['userRole'] == "Investor"){
                        
                        session_start();
    
                        $_SESSION['userName'] = $row['userName'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['userRole'] = $row['userRole'];
                        $_SESSION['userImage'] = $row['userImage'];
                        $_SESSION['username'] =$row['name'] ;
                        $_SESSION['title'] = $row['title'];
                        header('Location: Investor_Dashboard.php');

                        exit();
                    }
                    
                }
                else{
                    return true;
                    // echo "pass4";
                }
            }
            else{
                return true;
                // echo "pass4";
            }
        }

        public function updateAccount($con, $userName, $email, $title,$name , $image){
                // echo "pass2";
                $escaped_image = addslashes($image);
                $query = "UPDATE user_info set email='$email', name='$name', title = '$title', userImage='$escaped_image' WHERE userName = '$userName'";

                $result = mysqli_query($con, $query);

                if($result){
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $name;
                    $_SESSION['title'] = $title;
                    $_SESSION['userImage'] =base64_encode($image);
                }
                else{

                }
        }

        //Getter and setter
        public function getUserName(){
            return $this->userName;
        }

        public function getImage(){
            return $this->image;
        }

        public function getName(){
            return $this->name;
        }

        public function getTitle(){
            return $this->title;
        }

        
        public function setImage($image){
            $this->image = $image;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setTitle($title){
            $this->title = $title;
        }
    }

?>