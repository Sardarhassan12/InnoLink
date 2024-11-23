<?php
    include_once('BusinessOwnerClass.php');

    class BusinessIdea{
        private $ideaId;    // from system
        private $title;
        private $description;
        private $category;
        private $financeAmount;
        private $image;
        private $status;    // not used during registration
        private $owner; // from system
        private $rating = [];   // not used during registration

        public function __construct(BusinessOwner $owner,  $ideaId,  $title, $description, $category, $financeAmount, $image)
        {
            $this->owner = $owner;
            $this->ideaId = $ideaId;
            $this->title = $title;
            $this->description = $description;
            $this->category = $category;
            $this->financeAmount = $financeAmount;
            $this->image = $image;

        }

        //Getter and setter
        public function getideaId(){
            return $this->ideaId;
        }
        public function getTitle() {
            return $this->title;
        }
    
        public function getDescription() {
            return $this->description;
        }

        public function getFinance() {
            return $this->financeAmount;
        }

        public function getImage() {
            return $this->image;
        }
    }
?>