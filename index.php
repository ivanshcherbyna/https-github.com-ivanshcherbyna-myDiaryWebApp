<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script> 
function logout_script(){
        var btn = document.getElementById('logOutForm');
        btn.style.display="hidden";
	var formIn = document.getElementById('logInForm');//documentElement.getElementById('logOutForm').style.visibility='hidden';
	formIn.style.display='visible';
};
function login_script(){
	var formIn = document.getElementById('logIntForm');
        formIn.style.display="hidden";
	var btn = document.getElementById('logOutForm');//documentElement.getElementById('logOutForm').style.visibility='hidden';
	btn.style.display='visible';
};
</script>
        <title>My Diary Application</title>
        <style>
            body{
             background-image: url('http://maxpixel.freegreatpicture.com/static/photo/1x/Diary-Stone-Wall-Personal-Business-Background-1446082.jpg'); 
             background-size: cover;
        }
        </style>
    </head>
    
    
    <body>
         <header>
            
        <form class="form-group" id="logInForm" action="index.php?$page=2" method="post">
            <div class="row">
                <div class="col-sm-2 col-sm-push-9">
                    <div class="form-group">
              <!-- <label >Name:</label>-->
                    <input type="text" class="form-control" name="usr" placeholder="login"></div>
                    <div class="form-group">
              <!-- <label >Password:</label>-->
                <input type="password" class="form-control" name="pwd" placeholder="enter password">
                
            </div>
                    <button class="btn btn-default" name="LoginBtn" type="submit">LogIn</button>
            </div>
            </div>
        </form>
             <form id="logOutForm" style="visibility: hidden" action="index.php?$page=1" method="post">
            <div class="col-sm-3 col-sm-push-10">
               
                <button class="btn btn-primary" name="LogoutBtn" type="submit" onclick="logout_script()">LogOut</button>
            </div>
            
        </form>
    </header>
       
 <?php
 require_once ('pages/functions.php');
 if (isset($_POST['LoginBtn']))
     {
     
     get_user($_POST['usr'],$_POST['pwd']);
     
     }
 
    if (isset($_POST['LogoutBtn'])){
        logOff_user();
        
        }
?>
                
        <div class="container" style="padding-top: 5px;">
<div class="row">
 
    <header class="col-sm-12 col-md-12 col-lg-12">
        <?php include_once ('pages/menu.php');
              include_once ('pages/functions.php');
        ?>
    </header>
 </div>
            
 
 <nav class="col-sm-12 col-md-12 col-lg-12">
        </nav>
 
<div class="row">
 
    <section class="col-sm-12 col-md-12 col-lg-12">
        <?php
        if(isset($_GET['page'])){
            $page=$_GET['page'];
            if($page==1)                include_once ('pages/home.php');
            if($page==2)                include_once ('pages/upload.php');
            if($page==3)                include_once ('pages/gallery.php');
            if($page==4)                include_once ('pages/registration.php');
        }
        ?>
    </section>

    </div>
  </div>

 </body>
</html>
