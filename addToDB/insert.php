<?php
include './data/config.php';
include './dbservices.php';
include './jsonservices.php';
$jsonSrv = new jsonService('./data/user_info.json');
$data = $jsonSrv->jsontoArray();
$dbSrv = new dbServices($hostName,$userName,$password,$dbName);
if($dbSrv->dbConnect()){
    foreach($data as $json){
        $fields = [];
        $values = [];
        foreach($json as $key=>$val){
            array_push($fields,$key);
            if($key == "uid" || $key == "role" || $key == "age" || $key == "dis"){
                array_push($values,$val);
            }else{
                array_push($values,"'$val'");
            }
        }
        $dbSrv->insert('user_tb',$values,$fields);
    }
    echo "added";
}else{
    echo "problem";
}
$jsonSrv1 = new jsonService('./data/job.json');
$data = $jsonSrv1->jsontoArray();
$dbSrv = new dbServices($hostName,$userName,$password,$dbName);
if($dbSrv->dbConnect()){
    foreach($data as $json){
        $fields = [];
        $values = [];
        foreach($json as $key=>$val){
            array_push($fields,$key);
            if($key == "jobId" || $key == "uid" || $key == "salary" || $key == "dis"){
                array_push($values,$val);
            }else{
                array_push($values,"'$val'");
            }
        }
        $dbSrv->insert('ja_tb',$values,$fields);
    }
    echo "added";
}else{
    echo "problem";
}




?>