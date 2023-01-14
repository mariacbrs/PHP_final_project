<?php
    include './data/config.php';
    session_unset(); 
    //  when the user click in logout button or reload the page logout, will keep the session on the users computer but delete the variable  
    session_destroy();
    //  we place session destroy to delete the session, so nothing is storage.
    header("Location: ".$baseName.'index.php');
    // to bring the user to the index page so he can enter the website again if he wants to or leave it 
    exit();
?>