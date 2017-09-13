<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	//require_once("LayoutView.php");

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {

		

		$message = '';
		if(isset($_POST[self::$name]) || isset($_POST[self::$password])){
			
				
		
			$response = '';
				if($_POST[self::$name] == 'Admin' && $_POST[self::$password] == 'Password')
			{
				//SESSION
				$_SESSION['username'] = $_POST[self::$name];
				$_SESSION['password'] = $_POST[self::$password];
				$message = "Welcome";

				$response = $this->generateLogoutButtonHTML($message);

				
				return $response;
			} else 
			{
				$message = "Wrong name or password";
			}
			if ($_POST[self::$password] == '')
			{
				$message = "Password is missing";
			}
				if ($_POST[self::$name] == '')
			{
				$message = "Username is missing";
				
			}
		}

		if(isset($_POST[self::$logout])){
			echo "testar att logga utttttt";
			session_unset();
			//unset($_SESSION['username']);
		}

		if(isset($_SESSION['username'])){
			return $this->generateLogoutButtonHTML($message);
		}else {
			return $this->generateLoginFormHTML($message);
		}
			
				
				
	}

	public function logout(){
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message .  '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//Använd denna till att ha kvar namnet i value 
		}

		//RETURN REQUEST VARIABLE: USERNAME
//	}
	
}