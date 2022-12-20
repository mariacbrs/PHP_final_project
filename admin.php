<style>
  /* #bgimg{
    background-image: url(pic-06.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  } */
  *{
        margin: 0;
        padding: 0;
    }
    #box{
        display: flex;
        column-gap: 2vh;
    }
  section{
    display: flex;
    flex-wrap: wrap;
    row-gap: 2vh;
    column-gap: 2vh;
    height: 95vh;
  }
  article{
    width: 25%;
    background-color:navajowhite;
    border: 1px solid black;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    row-gap: 1vh;
    height: 100%;
  }
  button{
    width: 10vh;
  }
  img{
    width: 100%;
    height: 35vh;
  }
/* ------------------------- */
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
/* a{ */
/* display:block;
position:absolute;
float:left;
font-family:arial;
color:#fff;
text-decoration:none;
width:100%;
height:70px;
text-align:center; */
/* } */
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
if(isset($_GET['id'])){
  $file = fopen('./data/job.json','r');
  $datas = fread($file,filesize('data/job.json'));
  $datas = json_decode($datas,true);
  fclose($file);

  $jobsArray = [];
  foreach($datas as $data){
    if($data['jobId']==$_GET['id']){
      $data['dis'] = false;
    }
    array_push($jobsArray,$data);
  }
  $file = fopen('./data/job.json','w');
  fwrite($file,json_encode($jobsArray));
  fclose($file);
}
  $file = fopen("./data/job.json",'r');
  $jobArray = json_decode(fread($file,filesize("./data/job.json")),true);
  fclose($file);
  // print_r($jobArray);

?>

<div id="box">
  <nav>
    <ul>
      <li class="var_nav">
          <div class="link_bg"></div>
          <div class="link_title">
            <div class=icon> 
            <i class="fa-solid fa-house"></i>
            </div>
            <a href="<?php echo $baseName.'admin.php'; ?>"><span>Job list</span></a>
          </div>
      </li>
      <li class="var_nav">
          <div class="link_bg"></div>
          <div class="link_title">
            <div class=icon> 
            <i class="fa-regular fa-trash-can"></i>
            </div>
            <a href="<?php echo $baseName.'adminDelete.php'; ?>"><span>Deleted Job list</span></a>
          </div>
      </li>
      <li class="var_nav">
          <div class="link_bg"></div>
          <div class="link_title">
            <div class=icon> 
            <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <a href="<?php echo $baseName.'adminUserList.php';?>"><span>User List</span></a>
          </div>
      </li>
      <li class="var_nav">
          <div class="link_bg"></div>
          <div class="link_title">
            <div class=icon> 
            <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <a href="<?php echo $baseName.'adminUserDelete.php';?>"><span>Deleted User List</span></a>
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
  <section>
    <?php 
      foreach($jobArray as $job){
        if($job['dis']==false){
          continue;
        }else{
          echo "<article>";
          echo "<img src=".$job['img'].">";
          echo "<h3>jobId : ".$job['jobId']."</h3>"; 
          echo "<h3>Title : ".$job['title']."</h3>"; 
          echo "<h3>Address : ".$job['address']."</h3>"; 
          echo "<h3>Salary : ".$job['salary']."</h3>"; 
          echo "<h3>Content : ".$job['content']."</h3>"; 
          echo "<a href='".$_SERVER['PHP_SELF']."?id=".$job['jobId']."'>Delete</a>";
          echo "</article>";
        }
    }
    ?>
  </section>
  </div>
<?php include './pages/footer.php'; ?>
