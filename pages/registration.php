<h3>Registration Form</h3>
<?php
$obj= new DataBase();

if(!isset($_POST['regbtn']))
{
?>
<form action="index.php?page=4" method="post">
    <div class="form-group">
        <label for="login">Login:</label>
        <input type="text" class="form-control" name="login" required>
    </div> 
    <div class="form-group">
        <label for="pass1">Password:</label>
        <input type="password" class="form-control" name="pass1" required>
    </div>
    <div class="form-group">
           <label for="pass2">Confirm Password:</label>
        <input type="password" class="form-control" name="pass2" required>
    </div>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" name="email" required>
    </div>
        <button type="submit" class="btn btn-primary" name="regbtn">Register</button>
</form>
<?php
}
else
{
    $reg=$obj->registration($_POST['login'],$_POST['pass1'],$_POST['email']);
   // $reg=registration($_POST['login'],$_POST['pass1'],$_POST['email']);
    /* @var $reg type -> is result of reg. parametres */
    if($reg)
    {
       $obj->registration($_POST['login'],$_POST['pass1'],$_POST['email']);
       
       echo "<h3/><span style='color:green;'> New User Added!</span><h3/>";
    }
 else {
        "<h3/><span style='color:red;'> ERROR User Add!</span><h3/>";
    }
}
?>