<?php

session_start();


if(isset($_SESSION['Username']))
{
  header('Location: account.php');
  include 'init.php';
  include 'includes/templets/accountNavbar.php';
}

if(isset($_POST['user_id'])){
  $_SESSION['Username']  = $_POST['username'];
  $_SESSION['user_id']  = $_POST['user_id'];
}


else if(!isset($_SESSION['Username'])){
 
  include 'init.php';
  include 'includes/templets/dashboardNavbar.php';


?>





<!-- login modal-->
<div class="modal" id="login" tabindex="-1" role="dialog" aria-labelledby="loginTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal_size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="padding: 5px 8px;">Login</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 25px;padding: 6px;">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email"  name="username" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" required="required">
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required="required">
          </div>

          <div class="form-group">
              <button class="btn btn-primary" onclick="login()">Login</button>
          </div>
      </div>
    </div>
  </div>
</div>
<!--login modal-->




<!-- Dashboard -->

<section class="dashboard">
    <div class="container h-100">
      <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-5">
          <div class="hero-content">
            <h1 class="hero-title">
              Books Listing
            </h1>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos numquam tempora, iure delectus totam minus quam aperiam ratione dolores magni voluptates ut necessitatibus odio ipsum fuga, voluptas ab praesentium nihil?
            </p>
            <div class="hero-btn mt-5">
                <a href="signup.php"><button class="btn btn-editbutton">Join Now!</button></a>              
            </div>
          </div>
        </div>
        <div class="col-md-7">
            <img src="images/add3.jpg" class="img-fluid" alt="">
        </div>
      </div>
    </div>
</section>

<!-- Dashboard -->


<section class="about text-center">
  <div class="container">
    <h1>Create Your Own Book List </h1>
    <p class="lead">You Can Create Your Own Favourite List With Us Join Now And Have Fun</p>
    <button class="btn btn-outline editbutton">Learn More..</button>
  </div>  

</section>


<div></div>

<script type="text/javascript">



function login(){



  let req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == XMLHttpRequest.DONE) {
      checklogin(req.responseText);
    }
  };

  req.open("GET", "https://api.jsonbin.io/b/5f7bb1257243cd7e824b2767/latest", true);
  req.send();

}

function checklogin(data) {

  let jsonp = JSON.parse(data);


  var checkemail = document.getElementById("email").value;
  var checkpassword = document.getElementById("password").value;

  var i; var userexist = false
  for(i=0;i<jsonp['users'].length;i++)
  {

    if(jsonp['users'][i] == null) {continue;}
    if(jsonp['users'][i].email == checkemail && jsonp['users'][i].password == checkpassword)
    {
      userexist = true;
      console.log(jsonp['users'][i].email);
      $('#login').modal('hide');
      $.ajax({
            method:'POST',
            url:'index.php',
            data:{username:jsonp['users'][i].name,user_id:jsonp['users'][i].user_id},
            success:function(response){
            }
        })
       window.location.replace("account.php");
    }
  }
  if(userexist == false)
  {
    swal("email or password is incorrect", "", "error")
       .then((value) => {              
       });
  }
}



</script>


<?php 
    include $tpl . 'footer.php';
}?>
