<?php
require 'core/init.php';


$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if (Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6),
			'password_new' => array(
				'required' => true,
				'min' => 6),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new')
		));

		if($validation->passed()) {
			echo 'If you see this, it passed!';
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong.';
			} else {
				try {
					$salt = Hash::salt(32);
					$user->update(array(
						'password' => Hash::make(Input::get('password_new'), $salt),
						'salt' => $salt
					));
					Session::flash('home', 'Your password has been changed!');
					Redirect::to('index.php');
				} catch(Exception $e) {
					die($e->getMessage());
				}
			}
		} else {
			foreach($validate->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>


<form action="" method="post">
	<p><?php echo escape($user->data()->name); ?></p>
				
	<input class="textbox" type="password" name="password_current" id="password_current" placeholder="current password"><br /><br />
	<input class="textbox" type="password" name="password_new" id="password_new" placeholder="new password"><br /><br />
	<input class="textbox" type="password" name="password_new_again" id="password_new_again" placeholder="repeat new password"><br /><br />
	<input class="button-secondary" style="font-size: 120%;" type="submit" name="password_change" value="Change password">
	
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="logout.php">Log Out </a></li>
		<li><a href="update.php">Update details </a></li>
		<li><a href="changepassword.php">Change Password </a></li>
				
	</ul>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>