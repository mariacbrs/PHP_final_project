<?php
    include './data/config.php';
    include './data/jobClass.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $title = $_POST['title'];
        $address = $_POST['address'];
        $salary = $_POST['salary'];
        // $img = $_POST['img'];
        $content = $_POST['content'];
        $jobImg = $_FILES['img'];
        $targetDir = "./img/";

        if($jobImg['size']<400000){
            if($jobImg['type']=="image/jpeg" || $jobImg['type']=="image/jpg"){
                if(move_uploaded_file($jobImg['tmp_name'],$targetDir.$jobImg['name'])){
                    $newJob = new job($title,$address,$salary,$jobImg['name'],$content);
                    // print_r($newJob->convert_info());
                    $file = fopen('./data/job.json','r');
                    $jobArr = json_decode(fread($file,filesize('./data/job.json')),true);
                    $jidNum =count($jobArr)+1;
                    array_push($jobArr,$newJob->convert_info($jidNum));
                    fclose($file);
                    // print_r($jobArr);
                    $file = fopen('./data/job.json','w');
                    fwrite($file,json_encode($jobArr));
                    fclose($file);
            
                    header("Location: ".$baseName.'employer.php?msg=Registeration OK');
                    exit();
                }
            }
        }
    }
?>