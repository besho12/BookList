<?php
session_start();

if(!isset($_SESSION['Username'])){
  header('Location: index.php');
}

else if(isset($_SESSION['Username']))
{
  include 'init.php';
    include 'includes/templets/accountNavbar.php';  



$book_name = $book_author = $date = $book_cover = '';

$errors = array('book_name' => '' , 'book_author' => '' , 'date' => '' , 'book_cover' => '');

if (isset($_POST['add_book'])){

  //check book name////////////////////////////// 
    if(empty($_POST['book_name']))
    {
      $errors['book_name'] = "Enter Book Name";
    } 
    else 
    {
      $book_name = $_POST['book_name'];
      if(!preg_match('/[0-9a-zA-Z]{3,}/', $book_name))
      { //validation for email
        $errors['book_name'] = "Book Name lenght must be at least 3 characters";
      }
    }
    
    //check book author////////////////////////////// 
    if(empty($_POST['book_author']))
    {
      $errors['book_author'] = "Enter Book Author";
    } 
    else 
    {
      $book_author = $_POST['book_author'];
      if(!preg_match('/[0-9a-zA-Z]{3,}/', $book_author))
      { //validation for email
        $errors['book_author'] = "Book Author lenght must be at least 3 characters";
      }
    }

    //check book author////////////////////////////// 
    if(empty($_POST['date']))
    {
      $errors['date'] = "Enter Book Relase Date";
    } 
    else 
    {
      $date = $_POST['date'];
      if(!preg_match('/([0-9]{4,}(-)[0-9]{2,}(-)[0-9]{2,}){1,}/', $date))
      { //validation for email
        $errors['date'] = "Book Date must be in this format yyyy-mm-dd";
      }
    }
    
    // Get book image to store it //////////
    $imageName   = $_FILES['images']['name'];
    $imagetmp    = $_FILES['images']['tmp_name'];
    $image = rand(0,1000000). '_' . $imageName;
    move_uploaded_file($imagetmp, "uploads/images/" .  $image );




    ////////////////////////////////////////



    // if no error in information
    if($errors['book_name'] == '' && $errors['book_author'] == '' && $errors['date'] == '')
    { // Save the informations in server and redirect ?>
      

      <script type="text/javascript">


      let req = new XMLHttpRequest();

      req.onreadystatechange = () => {
        if (req.readyState == XMLHttpRequest.DONE) {
          updates(req.responseText);
          //deletebook(req.responseText);
        }
      };

      req.open("GET", "https://api.jsonbin.io/b/5f7bb229302a837e95753884/latest", true);
      req.send();


   function updates(json) {


     let jsonp = JSON.parse(json);

    jsonp['books'].push({"user_id": "<?php echo $_SESSION['user_id']?>","book_id":"<?php echo rand().rand()?>","book_name":"<?php echo $_POST['book_name'] ?>","book_author":"<?php echo $_POST['book_author'] ?>", "date":"<?php echo $_POST['date'] ?>","img":"<?php echo $image ?>"});

     let jsonsend = JSON.stringify(jsonp);

     let req = new XMLHttpRequest();

      req.onreadystatechange = () => {
        if (req.readyState == XMLHttpRequest.DONE) {
          swal("One book has been added successfully!", "Congratulations", "success")
           .then((value) => {              
              window.location.replace("account.php");
           });
        }
      };

      req.open("PUT", "https://api.jsonbin.io/b/5f7bb229302a837e95753884", true);
      req.setRequestHeader("Content-Type", "application/json");
      req.setRequestHeader("versioning", "false");

      req.send(jsonsend);

   }
        
      



      




        
      </script>
      <?php } ?>  

<?php } ?>



<section class="addbook">
  <div class="container">

    <h1>Add Book!!</h1>

        <div class="row">
           <div class="col-md-6">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"id="myform"enctype="multipart/form-data">
        <div class="form-group">
        <!--htmlspecialchars() to secure any thing print to browser-->
        <label class="form-check-label labels">Book Name:</label> 
        <input class="form-control" type="text" placeholder="Enter Book Name" name="book_name" value="<?php echo htmlspecialchars($book_name) ?>" required = "required">
        <div class="red-text"><?php echo $errors['book_name']; ?></div>
        <label class="form-check-label labels">Book Author:</label>
        <input class="form-control" type="text" placeholder="Enter Book Author" name="book_author" value="<?php echo htmlspecialchars($book_author) ?>" required = "required">
        <div class="red-text"><?php echo $errors['book_author']; ?></div>
        <label class="form-check-label labels">Relase Date</label>
        <input class="form-control" type="text" placeholder="yyyy-mm-dd" name="date" value="<?php echo htmlspecialchars($date) ?>" required ="required">
        <div class="red-text"><?php echo $errors['date']; ?></div>
        </div>
        <label class="form-check-label labels">Book Cover:</label> 
        <input class="form-control" type="file" name="images" autocomplete="off" required="required">
        <button class="btn btn-primary submit_button" type="submit" name="add_book" value="submit">Add Book</button>   
      </form>
       </div>

       <div class="col-md-6">
        <img src="images/add2.jpg" class="img-fluid" alt="">
       </div>
    </div>
  </div>
</section>







<?php 
    include $tpl . 'footer.php';
}?>