<?php
$con = mysqli_connect('localhost', 'root', '', 'innolink');
if(!$con){
   echo "Connection Error";
}

    $query = "select * from businessidea where BusinessOwnerUserName = 'ali' ";
    $result = mysqli_query($con, $query);

    if($result){
        while($data =  mysqli_fetch_assoc($result)){
            echo $data['ideaId']. " ". $data['title']. " ". $data['description']. " ". $data['category']. " ". $data['finance']. " ". $data['image'];
        }
    }


?>
