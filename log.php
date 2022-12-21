<?php
    include './data/config.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $role = $_POST['role'];
        if($_POST['token']!==$_SESSION['token']){
            echo "You used wrong Login Form!!!";
            exit();
        }else{
            if($role == 'employer'){
                $file = fopen('./data/employer.json','r');
                $empArray = json_decode(fread($file,filesize('./data/employer.json')),true);
                foreach($empArray as $emp){
                    if($emp['email']==$email && $emp['password']==$pass){
                        $_SESSION['logUser'] = $emp;
                        header("Location: ".$baseName.'employer.php');
                        exit();
                    }else{
                        header("Location: ".$baseName.'index.php'); 
                    }
                }  
            }else{
                $file = fopen('./data/admin.json', 'r');
                $adminArray = json_decode(fread($file,filesize('./data/admin.json')),true);
                foreach($adminArray as $admin){
                    if($admin['email']==$email && $admin['password']==$pass){
                        $_SESSION['logUser'] = $admin;
                        header("Location: ".$baseName.'admin.php');
                        exit();
                    }else{
                        header("Location: ".$baseName.'index.php'); 
                    }
                }  
            }
            header("Location: ".$baseName.'index.php?msg=1');
            exit();   
        }
        
    }
?>

