<?php

namespace model; 

require_once("view/LoginView.php");

class LoginModel {

    public function __construct() {
        $loginView = new \view\LoginView();
    }

        //DENNA KOMMER FRÅN LOGINVIEW//
    public function login(){
		$username = $this->loginView->getRequestUserName();
        $password = $this->loginView->getRequestPassword();
        $keep = $this->loginView->keep();
        $logout = $this->loginView->logout();

		 $random = password_hash("Password", PASSWORD_DEFAULT);
		if(isset($username) || isset($password))
		{
			$response = '';

			if($username == 'Admin' && password_verify($password, $random))
			{
				if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
				{
					$this->message = "Welcome";
				} 
			    $_SESSION['username'] = $username;
			    $_SESSION['password'] = $random;
                    if(isset($keep))
				    {
					$this->keepUserLoggedIn(); 
					$this->message = "Welcome and you will be remembered";
				    }	
			    $response = $this->generateLogoutButtonHTML($this->message);
			    return $response;
			} 
			else 
			{
				$this->message = "Wrong name or password";
			}

			if ($password == '')
			{
				$this->loginView->getRequestUserName();
				$this->message = "Password is missing";
			}
			
			if ($username == '')
			{
				$this->message = "Username is missing";
			}
		} else if (isset($_COOKIE[self::$cookieName]) && isset($_COOKIE[self::$cookiePassword]))
			{
				if($_COOKIE[self::$cookieName] == 'Admin' && password_verify("Password", $_COOKIE[self::$cookiePassword]))
				{
					if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
					{
						$this->message = "Welcome back with cookie";
					} 
				$_SESSION['username'] = $_COOKIE[self::$cookieName];
				$_SESSION['password'] = $_COOKIE[self::$cookiePassword];
				} else 
				{
					$this->message = "Wrong information in cookies";
					setcookie(self::$cookieName, '', time()-3600);
					setcookie(self::$cookiePassword, '', time()-3600);
				}
			}
		if(isset($logout))
		{
			if(isset($_SESSION['username']) && isset($_SESSION['password']))
			{
				$this->message = "Bye bye!";
			}
            session_unset();
            
            //Om session_status = false(stängd) -> skicka någonting till vyn som säger att cookies ska bli '' 
			setcookie(self::$cookieName, '', time()-3600);
			setcookie(self::$cookiePassword, '', time()-3600);
		}

		//if(isset($_SESSION['username']))
		//{			
		//	 $this->generateLogoutButtonHTML($this->message);
		//}
    }

    public function isLoggedIn() {
        if(isset($_SESSION['username'])){
            return true;
        } else 
        {
            return false; 
        }
    }

    //osäker på om denna ska vara här
    private function keepUserLoggedIn() {
		setcookie(self::$cookieName, $_SESSION['username'], time()+3600);
		setcookie(self::$cookiePassword, $_SESSION['password'], time()+3600);
	}

}