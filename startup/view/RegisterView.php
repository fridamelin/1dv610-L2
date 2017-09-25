<?php


class RegisterView {
  private static $login = 'RegisterView::UserName';
  private static $messageId = 'RegisterView::Message';
  private static $password = 'RegisterView::Password';
  private static $checkPassword = 'RegisterView::PasswordRepeat';
  private static $register = 'RegisterView::Registration';
  private $message = '';


  public function register(){
    if(isset($_POST[self::$register])){
      if(strlen($_POST[self::$login]) < 3){
        $this->message = 'Username has too few characters, at least 3 characters.';
      }if(strlen($_POST[self::$password]) < 6){
        $this->message = 'Password has to few characters, at least 6 characters.';
      }if(strlen($_POST[self::$login]) < 3 && strlen($_POST[self::$password]) < 6 ){
        $this->message = 'Username has too few characters, at least 3 characters.<br>
        Password has to few characters, at least 6 characters';
      }
    }
  }
  
  public function response() {
    $this->register();
   
    return '
			<h2>Register new user</h2>
			<form action="?register" method="post" enctype="multipart/formdata">
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
						<p id="' . self::$messageId . '">' . $this->message .  '</p>
					<label for="' . self::$login . '" >Username :</label>
					<input type="text" size="20" name="'. self::$login .'" id="'. self::$login .'" value="" />
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="20" name="'. self::$password .'" id="' . self::$password . '" value="" />
					<br>
					<label for="' . self::$checkPassword .'" >Repeat password :</label>
					<input type="password" size="20" name="' . self::$checkPassword . '" id="' . self::$checkPassword . '" value="" />
					<br>
					<input id="submit" type="submit" name="' . self::$register . '"  value="Register" />
					<br>
				</fieldset>
        </form>
          ';
  }

  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
 
}
