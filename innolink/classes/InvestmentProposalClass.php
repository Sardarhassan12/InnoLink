<?php

    include_once 'InvestorClass.php';
    include_once 'BusinessIdeaClass.php';
    class InvestmentProposal{

        private $investmentId;
        private $investmentType;
        private $investmentAmount;
        private $investor;
        private $businessIdea;
        private $status;

        public function __construct($investmentId, $investmentType, $investmentAmount,Investor $investor,BusinessIdea $businessIdea, $status)
        {
            $this->investmentId = $investmentId;
            
            $this->investmentType = $investmentType;
            
            $this->investmentAmount = $investmentAmount;
            
            $this->investor= $investor;

            $this->businessIdea = $businessIdea;
            
            $this->status = $status;
            
            
        }

        public function getInvestmentId() {
            return $this->investmentId;
        }
    
        public function getInvestmentType() {
            return $this->investmentType;
        }
    
        public function getInvestmentAmount() {
            return $this->investmentAmount;
        }
    
        public function getInvestor() {
            return $this->investor;
        }
    
        public function getBusinessIdea() {
            return $this->businessIdea;
        }

        public function getInvestmentStatus() {
            return $this->status;
        }
        
    }

?>