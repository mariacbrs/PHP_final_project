<?php
    include './data/config.php';
    include './data/applyerClass.php';
    include './pages/header.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        // $fname = $_POST['fname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $pass = $_POST['pass'];
        $applyer = new applyer($fname,$lname,$email,$phone,$pass,$age);
        $file = fopen('./data/user_info.json','r');
        $applyArray = json_decode(fread($file,filesize('./data/user_info.json')),true);
        foreach($applyArray as $value){
            if($value['pass']==$pass){
                header("Location: ".$baseName."applyer.php?pass=".$pass);
                exit();
            }else{
                $idNum =count($applyArray)+1;
                array_push($applyArray,$applyer->convert_info($idNum));
                fclose($file);
                $file = fopen('./data/user_info.json','w');
                fwrite($file,json_encode($applyArray));
                fclose($file);
                header("Location: ".$baseName.'?msg=Registeration OK');
                exit();
            }
        }
    }
?>
<?php include './pages/footer.php'; ?>
