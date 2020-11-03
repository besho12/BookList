<?php
session_start();



include 'init.php';
include 'includes/templets/signupNavbar.php';

$email = $name = $password = '';

$errors = array('email' => '' , 'name' => '' , 'password' => '');

if (isset($_POST['submit'])){

	//check email////////////////////////////// 
  	if(empty($_POST['email']))
  	{
  		$errors['email'] = "Enter your email";
  	} 
  	else 
  	{
		$email = $_POST['email'];
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{ //validation for email
			$errors['email'] = "Email must be valid";
	    }
    }
    
    //check name////////////////////////////// 
    if(empty($_POST['name']))
  	{
  		$errors['name'] = "Enter your name";
  	} 
  	else 
  	{
		$name = $_POST['name'];
        if(!preg_match('/[0-9a-zA-Z]{6,}/', $name)){
  			$errors['name'] = "Name lenght must be at least 6 characters";
  		}   
    }
    //check password////////////////////////////// 
    if(empty($_POST['password']))
  	{
  		$errors['password'] = "Enter your password";
  	} 
  	else 
  	{
		$password = $_POST['password'];
		$hashpass = sha1($password);
        if(!preg_match('/[0-9a-zA-Z]{6,}/', $password)){
  			$errors['password'] = "Password lenght must be at least 6 characters";
  		}   
    }

    // if no error in information
    if($errors['email'] == '' && $errors['name'] == '' && $errors['password'] == '')
  	{ // Save the informations in server and redirect ?>
  		

      <script type="text/javascript">
      
////////////////////////////////////////////////////////////////

      let req = new XMLHttpRequest();

      req.onreadystatechange = () => {
        if (req.readyState == XMLHttpRequest.DONE) {
          signup(req.responseText);
          //deletebook(req.responseText);
        }
      };

      req.open("GET", "https://api.jsonbin.io/b/5f7bb1257243cd7e824b2767/latest", true);
      req.send();


   function signup(json) {


     let jsonp = JSON.parse(json);

     jsonp['users'].push({"user_id": "<?php echo rand().rand()?>", "email" : "<?php echo $_POST['email'] ?>","name": "<?php echo $_POST['name'] ?>", "password": "<?php echo $_POST['password'] ?>"});

     let jsonsend = JSON.stringify(jsonp);

     let req = new XMLHttpRequest();

      req.onreadystatechange = () => {
        if (req.readyState == XMLHttpRequest.DONE) {
          swal("You signed up successfully!", "Sign in now to go to your account", "success")
           .then((value) => {
               window.location.replace("index.php");
           });
        }
      };

      req.open("PUT", "https://api.jsonbin.io/b/5f7bb1257243cd7e824b2767", true);
      req.setRequestHeader("Content-Type", "application/json");
      req.setRequestHeader("versioning", "false");

      req.send(jsonsend);



}
        
      </script>
  <?php } ?>
  <?php } ?>


<section class="signup">
	<div class="container">

		<h1>Sign Up!!</h1>

        <div class="row">
           <div class="col-md-6">
		    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="form-group">
				<!--htmlspecialchars() to secure any thing print to browser-->
				<label class="form-check-label labels">Email:</label> 
				<input class="form-control" type="text" placeholder="Enter Your Email" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
				<div class="red-text"><?php echo $errors['email']; ?></div>
				<label class="form-check-label labels">Full Name:</label>
				<input class="form-control" type="text" placeholder="Enter Your Full Name" name="name" value="<?php echo htmlspecialchars($name) ?>" required>
				<div class="red-text"><?php echo $errors['name']; ?></div>
				<label class="form-check-label labels">Password</label>
				<input class="form-control" type="Password" placeholder="Enter Your Password" name="password" value="<?php echo htmlspecialchars($password) ?>" required>
				<div class="red-text"><?php echo $errors['password']; ?></div>
				</div>
				<button class="btn btn-primary submit_button" type="submit" name="submit" value="submit">Sign Up</button>		
			</form>
		   </div>
		   <div class="col-md-6">
		   	<img src="images/profile.svg" class="img-fluid" alt="">
		   </div>
		</div>
	</div>
</section>







<?php 
    include $tpl . 'footer.php';
?>