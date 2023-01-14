<?php
    include './data/config.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $role = $_POST['role'];
        // the if is to pick the information that the user wrote in the form so we can use to check and start the session 
        if($_POST['token']!==$_SESSION['token']){
            echo "You used wrong Login Form!!!";
            exit(); 
        }else{
            if($role == 'employer'){
                $file = fopen('./data/user_info.json','r');
                $empArray = json_decode(fread($file,filesize('./data/user_info.json')),true);
                foreach($empArray as $emp){
                    if($emp['email']==$email && $emp['pass']==$pass){
                        $_SESSION['logUser'] = $emp;
                        header("Location: ".$baseName.'employer.php');
                        exit();
                    }else{
                        header("Location: ".$baseName.'index.php'); 
                    }
                }
<<<<<<< HEAD
            //if the user choose the role employer will search for the information in the userinfo file and check if all the information is corret, then if the information match will redirect the user to employer.php, otherwise the user will go back to the index.php to log in again. 
=======
>>>>>>> 35d5035a43d04a9cc8905fa822463896a1970bc1
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
            // if the admin page is selected the else loop will be executed and do the same thing as the if loop, so check the information and if everything is okay will start the session if not will redirect to the index php to login again
            header("Location: ".$baseName.'index.php?msg=1');
            // the else will run if the user is not registered into the system redirecting the user to the index that way he can register by clicking in the create an account
            exit();   
        }
        
    }
?>