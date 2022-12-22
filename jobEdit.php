<style>
*{
    margin: 0;
    padding: 0;
}
#box{
    display: flex;
    column-gap: 2vh;
}
form{
    width: 100%;
}
ul
{
margin:0px;
padding:0px;
list-style-type:none;
-webkit-backface-visibility: hidden; backface-visibility: hidden;  
}
.var_nav
{
position:relative;
background:#ccc; 
width:300px;
height:70px;
margin-bottom:5px;
}
.link_bg
{
 width:70px;
 height:70px;
 position:absolute;
 background:#E01B6A;
 color:#fff;
 z-index:2;
}
.link_bg i
{
 position:relative;
}
.link_title
{
position:absolute;
width:100%;
z-index:3;
color:#fff;
}
.link_title:hover .icon
{
-webkit-transform:rotate(360deg);
-moz-transform:rotate(360deg);
-o-transform:rotate(360deg);
-ms-transform:rotate(360deg);
transform:rotate(360deg);  
}
.var_nav:hover .link_bg
{
width:100%;
background:#E01B6A;
-webkit-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-ms-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;  
}
.var_nav:hover a
{
font-weight:bold;
-webkit-transition:all .5s ease-in-out;
-moz-transition:all .5s ease-in-out; 
-o-transition:all .5s ease-in-out; 
-ms-transition:all .5s ease-in-out;
 transition:all .5s ease-in-out;  
}
.icon
{
position:relative;
width:70px;
height:70px;
text-align:center;
color:#fff;
-webkit-transition:all .5s ease-in-out;
-moz-transition:all .5s ease-in-out; 
-o-transition:all .5s ease-in-out; 
-ms-transition:all .5s ease-in-out;   
float:left;
transition:all .5s ease-in-out;   
float:left;  
}
.icon i{top:22px;position:relative;}
a{
/* display:block;
position:absolute;
float:left; */
font-family:arial;
color:#fff;
text-decoration:none;
/* width:100%;
height:70px;
text-align:center; */
}
span
{
margin-top:25px;
display:block;
}
</style>
<?php 
include './pages/header.php';
if(!isset($_SESSION['logUser'])) {
    header("Location: ".$baseName.'index.php');
    exit();
}
  $file = fopen("./data/job.json",'r');
  $jobArray = json_decode(fread($file,filesize("./data/job.json")),true);
  fclose($file);
?>

<?php 
// if(isset($_GET['key'])){
//   $idx = $_GET['key'];
//   $jobArray[$idx]['dis']=false;
//   $file = fopen('./data/job.json','w');
//   fwrite($file,json_encode($jobArray));
//   fclose($file);
//   header("Location: ".$baseName.'admin.php');
// }

?>

<div id="box">
    <nav>
        <ul>
            <li class="var_nav">
                <div class="link_bg"></div>
                <div class="link_title">
                    <div class=icon> 
                    <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                    <a href="<?php echo $baseName.'employer.php'; ?>"><span>My page</span></a>
                </div>
            </li>
            <li class="var_nav">
                <div class="link_bg"></div>
                <div class="link_title">
                    <div class=icon> 
                    <i class="fa-solid fa-plus"></i>
                    </div>
                    <a href="<?php echo $baseName.'empPost.php'; ?>"><span>Post new Job</span></a>
                </div>
            </li>
            <li class="var_nav">
                <div class="link_bg"></div>
                <div class="link_title">
                    <div class=icon> 
                    <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <a href="<?php echo $baseName.'logout.php';?>"><span>LogOut</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <form method="POST" action="<?php
     if(isset($_GET['id'])){
        $ph = $_GET['id'];
     }else{
        $ph = $_GET['id2'];
     }
     echo $_SERVER['PHP_SELF'].'?id2='.$ph
     ?>" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control" name="title" placeholder="title" required>
            <label for="formId1">title</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control" name="address" placeholder="address" required>
            <label for="formId1">address</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="number"
                class="form-control" name="salary" placeholder="salary" required>
            <label for="formId1">salary</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="file"
                class="form-control" name="img" placeholder="image" required>
            <label for="formId1">image</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control" name="content" placeholder="content" required>
            <label for="formId1">content</label>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form> 
</div>
<?php
    if(isset($_GET['id'])){
        $dbCon = new mysqli($hostName,$userName,$password,$dbName);
        if($dbCon->connect_error){
        echo "connect error";
        }else{
        $sql = "SELECT * FROM ja_tb";
        $result = $dbCon->query($sql);
        foreach($result as $data){
            if($data['jobid']==$_GET['id']){
                echo "<section>
                <h5>Current data</h5>
                <div>Title : ".$data['title']."</div>
                <div>Adrdess : ".$data['address']."</div>
                <div>Salary : ".$data['salary']."</div> 
                <div>Content : ".$data['content']."</div>
                </section>"; 
        }}}
    }

    if(isset($_GET['id2'])){
        $title = $_POST['title'];
        $address = $_POST['address'];
        $salary = $_POST['salary'];
        $content = $_POST['content'];
        $jobImg = $_FILES['img'];
        $targetDir = "./img/";
    
    
        if($jobImg['size']<400000){
            if($jobImg['type']=="image/jpeg" || $jobImg['type']=="image/jpg"){
                if(move_uploaded_file($jobImg['tmp_name'],$targetDir.$jobImg['name'])){
                    $dbCon = new mysqli($hostName,$userName,$password,$dbName);
                    $tmpID = $_SESSION['logUser']["uid"];
                    $tmpImg = "img/".$jobImg['name'];
    
                    if($dbCon->connect_error){
                    echo "connect error";
                    }else{
                    $sql = "SELECT * FROM ja_tb";
                    $result = $dbCon->query($sql);
                    }
                    foreach($result as $data){
                    if($data['jobid']==$_GET['id2']){
                        $sql = "UPDATE ja_tb SET title = "."'$title'". " , " ."address = " ."'$address'". " , " ."salary = " ."'$salary'". " , " ."img = " ."'$tmpImg'". " , " ."content = " ."'$content'". " WHERE jobid = ".$_GET['id2'].";";
                        $dbCon->query($sql);
                        $dbCon->close();
                        echo "<h5>Edited</h5>";
                        exit();
                    }
                    }
                    header("Location: ".$baseName.'employer.php?ms=Registeration OK');
                    exit();
                }
            }
        }
      }
    ?>

<?php include './pages/footer.php'; ?>


