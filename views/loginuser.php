<?php 

if($this->session->userdata('name')!=null)
{
redirect('MsgPortal/inbox/');	
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Message Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
<br>

<?php  
 echo $this->session->flashdata('msg');
?>


 <p  align="center"><font size="4" ><a data-toggle="modal" href="#myModal"><button type="button" class="btn btn-info btn-lg">New User<span class="glyphicon glyphicon-user" ></span></button></a></font></p>
 <br>
 





  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New User Login </h4>
        </div>
        <div class="modal-body">
         
   
      <form role="form"  data-toggle="validator" action=<?php echo base_url('MsgPortal/enteruser'); ?> method="post" >
   
   <div class="form-group">
      <label for="email" class="control-label">Email:</label>
      <input type="email" name="id" class="form-control" id="email" placeholder="Enter email" required>
	
    </div>
	   <div class="form-group">
	  <label for="uname" class="control-label">User Name:</label>
      <input type="text" class="form-control" name="uname" id="un" placeholder="Enter username" required>
	  
    </div>
    <div class="form-group">
      <label for="pwd" class="control-label">Password:</label>
      <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" required>
	  <br>
	     <label for="pwd" class="control-label">Confirm Password:</label>
      <input type="password" onkeyup="return passmatch()" class="form-control" name="pwdc" id="pwdc" placeholder="Confirm password" required><br>
	   	<div class="alert alert-warning" id="passwar" ><Strong><h3 id="strmsg"><b>NOTE!!</b></h3></strong>Passowords Need To Match</div>
		
	  </div>

    

    <button type="submit" id="newuser" class="btn btn-success" value="Login">Login</button>
	<button type="reset" class="btn btn-warning" value="Reset">Reset</button>
  </form>
    
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
        </div>
      </div>
      
    </div>
  </div>
  

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <form role="form" data-toggle="validator" action=<?php echo base_url('MsgPortal/chcklogin'); ?> method="post" >
    <div class="form-group">
      <label for="email" class="control-label" >Email:</label>
      <input type="email" class="form-control" name="mid" id="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
      <label for="pwd" class="control-label">Password:</label>
      <input type="password" class="form-control" name ="pss" id="pwd" placeholder="Enter password" required>
    </div>
   
	<br>
    <button type="submit" class="btn btn-success" value="Login">Login</button>
	<button type="reset" class="btn btn-warning" value="Reset">Reset</button>
  </form>
  
  
  
  
  
  
  
  
  
  
  
  
  
 </body>
 <script>
 //document.getElementById("passwar").style.visibility = "hidden";
 function passmatch()
 { 
 
	 var a=document.getElementById('pwd').value;
	
	 var b=document.getElementById('pwdc').value;
	  if(a!=b)
	  {
		document.getElementById("passwar").innerHTML = "Passwords Dont Match";
		  document.getElementById("newuser").disabled=true;
		  return false;
	  } 
	  else if(a==b)
	  {
		  document.getElementById("passwar").innerHTML = "Passwords Match";
		  document.getElementById("newuser").disabled=false;
		  return true;
	  }
	  
 }
 
 </script>
 </html>