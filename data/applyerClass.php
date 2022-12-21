<?php
    class applyer{
        private $ID;
        private $fname;
        private $lname;
        private $email;
        private $phone;
        private $pass;
        private $age;
        private $role=0;
        private $dis=1;
        function __construct($fname,$lname,$email,$phone,$pass,$age)
        {
            $this->ID=16;
            $this->ID = $this->ID+1;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->phone = $phone;
            $this->pass = $pass;
            $this->age = $age;
        }  
        function convert_info(){
            return ["id"=>$this->ID,"first_name"=>$this->fname,"last_name"=>$this->lname,"email"=>$this->email,"phone"=>$this->phone,"pass"=>$this->pass,"age"=>$this->age,"role"=>$this->role,"dis"=>$this->dis];
        }      
        function cal(){

        }
    }
?>