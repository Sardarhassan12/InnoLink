<?php

class Notification {
    private $sender;
    private $receiver;
    private $message;
    private $status;

    public function __construct($sender, $receiver, $message, $status = 'unread') {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->message = $message;
        $this->status = $status;
    }

    
    public function saveNotification($con) {
        $query = "INSERT INTO notifications (sender, receiver, message, status) VALUES 
                 ('$this->sender', '$this->receiver', '$this->message', '$this->status')";
        mysqli_query($con, $query);
    }

    
    public static function getNotifications($con, $receiver) {
        $query = "SELECT notificationId, message, created_at FROM notifications WHERE receiver = '$receiver' ORDER BY created_at DESC";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);  
    }

    public static function markAsRead($con, $notificationId) {
        $query = "UPDATE notifications SET status = 'read' WHERE notificationId = $notificationId";
        mysqli_query($con, $query);
    }
}
?>