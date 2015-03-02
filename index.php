<?php 
	require_once 'core/init.php';
	
	
	
	if(Session::exists('home')){
		echo '<p>' . Session::flash('home') . '<p>';
	}
	
	$user = new User();
	
	if($user->isLoggedIn()){
	?>
		<div id = "information" >
		<p><?php echo escape($user->data()->name); ?></p>
		<p>Member Since <?php echo escape($user->data()->joined); ?></p>
		
		<head>
			<link rel="stylesheet" type="text/css" href="includes/style/site.css">
		</head>
		
		
		
			<ul>
				<li><a href="logout.php">Log Out </a></li>
				<li><a href="changepassword.php">Change Password </a></li>
				<li><a href="update.php">Update details </a></li>
				
			</ul>
		</div>
		
		<div id ="main">
		<p>
			This is a main section
		
		</p>
		</div>
		
		<div id ="container">
		<p>
			This is a container section
		
		</p>
		</div>
		
		<div id ="footer">
		<p>
			This is a footer section
		
		</p>
		</div>
			
			<?php
				if($user->hasPermission('admin')){
					echo'<p>You are an Administor</p>';
					
				}
			
			
			
			}else{
				echo '<p> You need to <a href="login.php">Log in</a> or <a href="register.php">Register</a></p>';
				
			}
			

	

	
	
	/* echo $user->data()->username; */
	
	/* if(Session::exists('success')){
		echo Session::flash('success');
	} */
	
	/*$user = DB::getInstance()->query("SELECT * FROM users");*/
	

	
	/*$user = DB::getInstance()->insert('users', array(
		'username' =>'Alex',
		'password' =>'password',
		'salt' =>'salt'
		
		));*/
	
	
	
	
	/*if(!$user->count()){
		echo'No User';
	}else{
		foreach($user->results() as $user){
		echo 'Name: ';
		echo $user->name, '<br>';
		
		echo 'Username: ';
		echo $user->username, '<br>';
		
		echo 'Password: ';
		echo $user->password, '<br>';
		}
	}*/
	
	
	
	
	
	
	/*if(!$user->count()){
		echo'No User';
	}else{
		foreach($user->results() as $user){
		echo 'Name: ';
		echo $user->name, '<br>';
		
		echo 'Username: ';
		echo $user->username, '<br>';
		
		echo 'Password: ';
		echo $user->password, '<br>';
		}
	}*/
?>