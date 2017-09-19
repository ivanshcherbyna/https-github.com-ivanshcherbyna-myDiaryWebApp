<?php
class DataBase{
    protected $nameDataBase="mydiary_db";
    protected $hostDataBase="localhost";
    private $loginDataBase="root";
    private $passwordDataBase="";
    protected $link;
    
    
    function __construct() 
    {
       // $this->link=mysqli_connect($this->hostDataBase, $this->loginDataBase, $this->passwordDataBase, $this->nameDataBase);
    } 
    
    public function db_Connect()
    {
              
              //$link = mysqli_connect($hostDataBase, $loginDataBase, $passwordDataBase, $nameDataBase);
               $link = mysqli_connect($this->hostDataBase, $this->loginDataBase, $this->passwordDataBase, $this->nameDataBase);
             // $this->link=$link;
                if(!$link)
                    {
                echo "<h3 class='row col-xs-6 col-sm-3'><span style='color:red;'>
                 Error Database connect! </span></h3>";
                return false;
                     }
                 else 
                    {
               // echo "<H1>Connected succsessful to base ".$this->nameDataBase."</H1>";
                return $link;
                    }        
    }
            
            
    function get_user($name,$pass)
            {
    $err=[];
    $name = trim($name);
    $pass= md5(trim($pass));
    //$link= db_connect();
    $this->db_Connect(); //call into this method from another method
    
    $query=("SELECT login, password FROM users where login ='".$name."' AND password = '".$pass."'");
    $res= mysqli_query($this->db_Connect(),$query);
    if($res){
        echo "<h3><span style='color:green;'>Wellcome you are sucsess authorised!</span></h3>";

            session_start();
          $_SESSION['registered_user'] = $name;
          echo '<script>login_script();</script>';
          return true;
              }
            else if (!$res)
              {       
          echo "<h3 class='row col-xs-6 col-sm-3'><span style='color:red;'>
             Wrong name/password ! </span></h3>";
              return false;
              }
            }

    function logOff_user()
            {
     $_SESSION['registered_user']="";
    //session_destroy();
     echo "<h3 class='row col-xs-6 col-sm-3'><span style='color:red;'>
             User are logOut</span></h3>";
            }
            
    function registration($name_,$pass_,$email_)
          {
    $err = [];
    $link= $this->db_Connect();
   
// Check login
    if(!preg_match("/^[a-zA-Z0-9]+$/",$name_))
    {
        $err[] = "Login can have only English words & digits";
    }

    if(strlen($name_) < 3 or strlen($name_) > 30)
    {
        $err[] = "Login must have min 3 symbols & not more 30 symbols";
    }
 
    // Check, if not has user with this name in DB
    $query = mysqli_query($link, "SELECT login FROM users where login ='".$name_."'");
    
    if(mysqli_num_rows($query) > 0)
    { 
        $err[] = "User with this login exist in base";
    }

    // If not errors, add new user in DB
    if(count($err) == 0)
    {
       
        $login = $name_;

        // Trim spaces & to do encription
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

}
    
    
    
    
    
    
    
     
    

