<?php
    class job{
        private $title;
        private $address;
        private $salary;
        private $img;
        private $content;
        private $dis;
        function __construct($title,$address,$salary,$img,$content)
        {
            $this->title = $title;
            $this->address = $address;
            $this->salary = $salary;
            $this->img = "img/".$img;
            $this->content = $content;
            $this->dis = true;
        }  
        function convert_info($idNum){
            return ["jobId"=>$idNum,"uid"=>$_SESSION['logUser']["uid"],"title"=>$this->title,"address"=>$this->address,"salary"=>$this->salary,"img"=>$this->img,"content"=>$this->content,"dis"=>$this->dis];
        }
        
        function select($tbName,$fieldArr=null,$conditionArr=null,$operator=null){
            if($fieldArr!=null){
                $fields = implode(',',$fieldArr);
            }else{
                $fields = '*';
            }
            if($conditionArr!=null){
                $where = "WHERE";
                // $fieldNum = sizeof($conditionArr);            
                foreach($conditionArr as $key => $value){
                    $where .= "$key = $value";
                    if($key != array_key_last($conditionArr)){
                        $where .= " $operator"; 
                    }
                }
            }else{
                $where = "";
            }
            $selectCmd = "SELECT $fields FROM $tbName";
            $result = $this->dbcon->query($selectCmd);
            return $result;
        }
    }
?>