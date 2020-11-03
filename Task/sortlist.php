<?php

session_start();

include 'init.php';

if(!isset($_SESSION['Username'])){
  header('Location: index.php');
}

else if(isset($_SESSION['Username']))
{
  include 'init.php';
  include 'includes/templets/accountNavbar.php';

?>








<?php
  ///////////////////// Sort By Name /////////////////////////////////////////////////////////////////////////////////
  if(isset($_POST['sortname']))
  {?>
  	<script type="text/javascript">
  	

  	let req = new XMLHttpRequest();

	req.onreadystatechange = () => {
	  if (req.readyState == XMLHttpRequest.DONE) {
	    books(req.responseText);
	  }
	};

	req.open("GET", "https://api.jsonbin.io/b/5f7bb229302a837e95753884/latest", true);
	req.send();



	var user_id = <?php echo $_SESSION['user_id'] ?> ;

	function books(data) { // Display all user books

    let jsonp = JSON.parse(data);


    var book = document.getElementById('book');

	
    var books = new Array();


    var i;
	for(i=0;i<jsonp['books'].length;i++){
	      
	      if(jsonp['books'][i] == 'deleted' || jsonp['books'][i].user_id != user_id) {
	      		continue;
	      	}	      	
				
          else {
            books.push(jsonp['books'][i]);
          }
	  
	}


  var sorted = document.getElementById('book');

   

    function SortByName(x,y) {
      return ((x.book_name == y.Name) ? 0 : ((x.book_name > y.book_name) ? 1 : -1 ));
    }

    //Call Sort By Name
    books.sort(SortByName);
    console.log(books);



  var j;
  for(j=0; j<books.length; j++)
  {
    var row = `<div class="col-lg-7">
          <div class="card" style="">
            <img class="card-img-top img-fluid" style="width:100%;height:300px;"src="uploads/images/${books[j].img}" alt="Book Image">
            <div class="card-body">
              <h2 class="card-title">${books[j].book_name}</h2>
              <p class="card-text">By ${books[j].book_author}</p>
              <p class="card-text">Relase Date   ${books[j].date}</p>

              <form>                      
                <input type="button" onclick="deleteb(${books[j].book_id})" value="Delete" class="btn btn-danger delete_button">
              </form>

            </div>
          </div>
                 </div>`
          sorted.innerHTML +=  row
  }

}

  </script>

 <?php }

///////////////////// Sort By Author /////////////////////////////////////////////////////////////////////////////////


else if(isset($_POST['sortauthor']))
  {?>
    <script type="text/javascript">
    

    let req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == XMLHttpRequest.DONE) {
      books(req.responseText);
    }
  };

  req.open("GET", "https://api.jsonbin.io/b/5f7bb229302a837e95753884/latest", true);
  req.send();



  var user_id = <?php echo $_SESSION['user_id'] ?> ;

  function books(data) { // Display all user books

    let jsonp = JSON.parse(data);


    var book = document.getElementById('book');

  
    var books = new Array();


    var i;
  for(i=0;i<jsonp['books'].length;i++){
        
        if(jsonp['books'][i] == 'deleted' || jsonp['books'][i].user_id != user_id) {
            continue;
          }         
        
          else {
            books.push(jsonp['books'][i]);
          }
    
  }


  var sorted = document.getElementById('book');

   

    function SortByName(x,y) {
      return ((x.book_author == y.book_author) ? 0 : ((x.book_author > y.book_author) ? 1 : -1 ));
    }

    //Call Sort By Name
    books.sort(SortByName);
    console.log(books);



  var j;
  for(j=0; j<books.length; j++)
  {
    var row =    ` <div class="col-lg-7">
                    <div class="card" style="">
                      <img class="card-img-top img-fluid" style="width:100%;height:300px;"src="uploads/images/${books[j].img}" alt="Book Image">
                      <div class="card-body">
                        <h2 class="card-title">${books[j].book_name}</h2>
                        <p class="card-text">By ${books[j].book_author}</p>
                        <p class="card-text">Relase Date   ${books[j].date}</p>

                        <form>                      
                          <input type="button" onclick="deleteb(${books[j].book_id})" value="Delete" class="btn btn-danger delete_button">
                        </form>

                      </div>
                    </div>
                 </div>`


          sorted.innerHTML +=  row
  }

}



  </script>

 <?php }


  

  ///////////////////// Sort By Date /////////////////////////////////////////////////////////////////////////////////

  else if(isset($_POST['sortdate']))
  {?>
    <script type="text/javascript">
    

    let req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == XMLHttpRequest.DONE) {
      books(req.responseText);
    }
  };

  req.open("GET", "https://api.jsonbin.io/b/5f7bb229302a837e95753884/latest", true);
  req.send();



  var user_id = <?php echo $_SESSION['user_id'] ?> ;

  function books(data) { // Display all user books

    let jsonp = JSON.parse(data);


    var book = document.getElementById('book');

  
    var books = new Array();


    var i;
  for(i=0;i<jsonp['books'].length;i++){
        
        if(jsonp['books'][i] == 'deleted' || jsonp['books'][i].user_id != user_id) {
            continue;
          }         
        
          else {
            books.push(jsonp['books'][i]);
          }
    
  }


  var sorted = document.getElementById('book');

   


    function SortByDate(x,y) {
      var datex = new Date(x.date), datey = new Date(y.date);
      return datex - datey;
    }

    //Call Sort By Name
    books.sort(SortByDate);
    console.log(books);



  var j;
  for(j=0; j<books.length; j++)
  {
    var row =    ` <div class="col-lg-7">
                    <div class="card" style="">
                      <img class="card-img-top img-fluid" style="width:100%;height:300px;"src="uploads/images/${books[j].img}" alt="Book Image">
                      <div class="card-body">
                        <h2 class="card-title">${books[j].book_name}</h2>
                        <p class="card-text">By ${books[j].book_author}</p>
                        <p class="card-text">Relase Date   ${books[j].date}</p>

                        <form>                      
                          <input type="button" onclick="deleteb(${books[j].book_id})" value="Delete" class="btn btn-danger delete_button">
                        </form>

                      </div>
                    </div>
                 </div>`


          sorted.innerHTML +=  row
  }

}



  </script>

 <?php }


  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>
<section class="account">
  <div class="container">
    <div class="page" style="padding-top: 60px;">
    <div class="row">
      <div id="book">   
      </div>
    </div>
    </div>
  </div>
</section>




<script type="text/javascript">
  

function deleteb(id_to_delete) 
{
  let req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == XMLHttpRequest.DONE) {
      deletebook(req.responseText,id_to_delete);
    }
  };

  req.open("GET", "https://api.jsonbin.io/b/5f7bb229302a837e95753884/latest", true);
  req.send();


   function deletebook(json,id_to_delete) 

  {
     let jsonp = JSON.parse(json);

       var i;
       for(i=0;i<jsonp['books'].length;i++){



          if(jsonp['books'][i].book_id == id_to_delete)
          {
        jsonp['books'][i] = 'deleted';

        let jsonsend = JSON.stringify(jsonp);

        let req = new XMLHttpRequest();

        req.onreadystatechange = () => {
          if (req.readyState == XMLHttpRequest.DONE) {
            window.location.replace("account.php");
          }
        };

        req.open("PUT", "https://api.jsonbin.io/b/5f7bb229302a837e95753884", true);
        req.setRequestHeader("Content-Type", "application/json");
        req.setRequestHeader("versioning", "false");
            req.send(jsonsend);    
          }
    }
  }
}


</script>














<?php }

    include $tpl . 'footer.php';
?>