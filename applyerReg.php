<?php
    include './data/config.php';
    include './data/applyerClass.php';
    include './pages/header.php';
    include './addToDB/dbservices.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        // $fname = $_POST['fname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $pass = $_POST['pass'];
        // ---------------------------------------------
        // $dbcon = new mysqli($hostName,$userName,$password,$dbName);
        // $dbSrv = new dbServices($hostName,$userName,$password,$dbName);
        // if($dbcon->connect_error){
        //     echo "connect error";
        // }else{
        //     $Selectdata = $dbcon->query("SELECT * FROM user_tb");
        //     $num = 1;
        //     foreach($Selectdata as $vall){
        //             if($vall['pass']==$pass){
        //                 header("Location: ".$baseName."applyer.php?pass=".$pass);
        //                 exit();
        //             }
        //             $num = $num +1; 
        //     }
        //     $applyer = new applyer($fname,$lname,$email,$phone,$pass,$age);
        //     $newAppler = $applyer->convert_info($num);
            
        //     $fields = [];
        //     foreach($Selectdata as $vall){
        //         foreach($vall as $key =>$val){
        //             array_push($fields,`$key`);
        //         }
        //         break;
        //     }
        //     $values = [];
        //     foreach($newAppler as $key =>$val){
        //         if($key == "uid" || $key == "age" || $key == "role" || $key == "dis"){
        //             array_push($values,$val);
        //         }else{
        //             array_push($values,"'$val'");
        //         }
        //     }
            // $newFields = implode(',',$fields);
            // $newValues = implode(',',$values);
            // echo $newFields;
            // echo $newValues;
            // if($dbSrv->dbConnect()){
            //     $dbSrv->insert('user_tb',$fields,$values);
                // $dbcon->close();
        //         echo "good";
        //     }
        // }
        // --------------------------------------------------
        
        
        $applyer = new applyer($fname,$lname,$email,$phone,$pass,$age);
        $file = fopen('./data/user_info.json','r');
        $applyArray = json_decode(fread($file,filesize('./data/user_info.json')),true);
        fclose($file);
        foreach($applyArray as $value){
            if($value['pass']==$pass){
                header("Location: ".$baseName."applyer.php?pass=".$pass);
                exit();
            }
        }
        // $applyer = new applyer($fname,$lname,$email,$phone,$pass,$age);
        $idNum =count($applyArray)+1;
        array_push($applyArray,$applyer->convert_info($idNum));
        $file = fopen('./data/user_info.json','w');
        fwrite($file,json_encode($applyArray));
        fclose($file);
        header("Location: ".$baseName.'?m=Registeration OK');
        exit();
    }
?>
<?php include './pages/footer.php'; ?>
