<?php
require_once 'core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));
			
			if($validation->passed()){
				$user = new User();
				
				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);
				
				if($login){
					Redirect::to('index.php');
				} else {
					echo '<p>Sorry, logging in failed.</p>';
				}
			} else{
				foreach($validation->errors() as $error){
					echo $error, '<br>';
				}
			}
		}
	}


?>

<form action="" method="post">
<table>
	<tr>
		<div class="field">
			<td><label for="username"> Username </label></td>
			<td><input type="text" name="username" id="username" autocomplete="off"></td>
		</div>
	</tr>
	
	
	<tr>
		<div class="field">
			<td><label for="password">Password</label></td>
			<td><input type="password" name="password" id="password" autocomplete="off"></td>
		</div>
	</tr>
	
	<table>
		<tr>
			<td><input type="hidden" name="token" value="<?php echo Token::generate();?>"></td>
			<td><input type="submit" value="login"></td>
		</tr>
		<tr>
			<div class="field">
				<td><label for="remember"></td>
				<td><input type="checkbox" name="remember" id="remember" > Remember me</label></td>
			</div>
		</tr>
		
	</table>
</table>
</form>
