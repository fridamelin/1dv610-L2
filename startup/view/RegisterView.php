<?php


class RegisterView {
  private static $login = 'RegisterView::Username';
  private static $messageId = 'RegisterView::Message';
  private static $password = 'RegisterView::Password';
  private static $checkPassword = 'RegisterView::PasswordRepeat';

  
  public function response() {
    return '
			<h2>Register new user</h2>
			<form method="post">
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '"></p>
					<label for="' . self::$login . '" >Username :</label>
					<input type="text" size="20" name="'. self::$login .'" id="'. self::$login .'" value="" />
					<br>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="20" name="'. self::$password .'" id="' . self::$password . '" value="" />
					<br>
					<label for="' . self::$checkPassword .'" >Repeat password :</label>
					<input type="password" size="20" name="' . self::$checkPassword . '" id="' . self::$checkPassword . '" value="" />
					<br>
					<input id="submit" type="submit" name="DoRegistration"  value="Register" />
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
