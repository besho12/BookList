<?php
session_start();

if(!isset($_SESSION['Username'])){
  header('Location: index.php');
}

else if(isset($_SESSION['Username']))
{
  include 'init.php';
  include 'includes/templets/accountNavbar.php';
  $search_field =  $_POST['search_field'];
?>
  
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

    search = '<?php echo $search_field; ?>';


    var i;
    var emptylist = true;
	for(i=0;i<jsonp['books'].length;i++){
	      
	      if(jsonp['books'][i] == 'deleted' || jsonp['books'][i].user_id != user_id)
	      	{continue;}
	      	if(jsonp['books'][i].book_name==search || jsonp['books'][i].book_author==search)
	      	{
	      		emptylist = false;
				var row = `<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="card" style="">
					  <img class="card-img-top img-fluid" style="width:100%;height:300px;"src="uploads/images/${jsonp['books'][i].img}" alt="Book Image">
					  <div class="card-body">
					    <h2 class="card-title">${jsonp['books'][i].book_name}</h2>
					    <p class="card-text">By ${jsonp['books'][i].book_author}</p>
					    <p class="card-text">Relase Date   ${jsonp['books'][i].date}</p>

					    <form>                      
					      <input type="button" onclick="deleteb(${jsonp['books'][i].book_id})" value="Delete" class="btn btn-danger delete_button">
					    </form>

					  </div>
					</div>
	               </div>`
	        	book.innerHTML +=  row

	      	}	        
	  
	}

	if(emptylist == true)
	{
		  var list = document.getElementById('list');

     	  var row = `<p>There Is No Result</p>`;

		  list.innerHTML = row
	}


}



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



<section class="emptypage">
<div class="container">
	<div class="list" id="list">
				
	</div>
</div>
</section>


<?php 
    include $tpl . 'footer.php';
}?>