<?php
function db_connect(){
$link = mysqli_connect("localhost", "root", "", "mydiary_db");
if(!$link){
    echo "<h3 class='row col-xs-6 col-sm-3'><span style='color:red;'>
         Error Database connect! </span></h3>";
return false;

        }
    else 
        return $link;
}
function get_user($name,$pass){
    $err=[];
    $name = trim($name);
    $pass= md5(trim($pass));
    $link= db_connect();
    
    $query=("SELECT login, password FROM users where login ='".$name."' AND password = '".$pass."'");
    $res= mysqli_query($link,$query);
    if($res){
        echo "<h3><span style='color:green;'>Wellcome you are sucsess authorised!</span></h3>";

            session_start();
          $_SESSION['registered_user'] = $name;
          echo '<script>login_script();</script>';
          return true;
         }
    else if (!$res){       
        echo "<h3 class='row col-xs-6 col-sm-3'><span style='color:red;'>
         Wrong name/password ! </span></h3>";
            return false;
       }
 }
function logOff_user(){
     $_SESSION['registered_user']="";
    //session_destroy();
 }
 
function registration($name_,$pass_,$email_){
    $err = [];
    $link= db_connect();
   
// проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$name_))
    {
        $err[] = "Login can have only English words & digits";
    }

    if(strlen($name_) < 3 or strlen($name_) > 30)
    {
        $err[] = "Login must have min 3 symbols & not more 30 symbols";
    }

    
    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT login FROM users where login ='".$name_."'");
    
    if(mysqli_num_rows($query) > 0)
    { 
        $err[] = "User with this login exist in base";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
       
        $login = $name_;

        // Убераем лишние пробелы и делаем шифрование
        $password = md5(trim($pass_));

        mysqli_query($link,"INSERT INTO users SET login='".$login."', user_password='".$password."', e-mail='".$email_."'");
        echo "<h3/><span style='color:green;'>
           User ".$login." successfully added in base!</span><h3/>";
        
       // header("Location: login.php"); exit();
    }
     else
    {
        print "<h4/><span style='color:red;'>При регистрации произошли следующие ошибки:</span></h4>";
        foreach($err AS $error)
        {
            print "<h3/><span style='color:red;'>".$error."</span><h3/>";
        }
    }
    
}
    
    
    
    
    
    
    
     
    

