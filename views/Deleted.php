<?php 

if($this->session->userdata('name')==null)
{
redirect('MsgPortal/loginuser/');	
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
<div>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" ><?php echo $this->session->userdata('name');?></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
	  <li><a></a></li>
	  <li><a></a></li>
	  <li><a></a></li>
	  <li><a></a></li>
	  <li><a></a></li>
	  <li><a></a></li>
	   <li><a></a></li>
	 
	   <li><a data-toggle="modal" href="#myModal">New Message</a></li>
        <li ><a href=<?php echo base_url('MsgPortal/inbox/'); ?>>Inbox</a></li>
        <li><a href=<?php echo base_url('MsgPortal/sent/'); ?>>Sent</a></li>
        <li><a href=<?php echo base_url('MsgPortal/replied/'); ?>>Replied</a></li>
		<li class="active"><a href=<?php echo base_url('MsgPortal/deleted/'); ?>>Deleted</a></li>
	    <li ><a href=<?php echo base_url('MsgPortal/logout/'); ?>>Logout</a></li>
		
		</ul>
    </div>
  </div>
</nav>
</div>
<p align="right"><input type="text" placeholder="Search" style="border:1px solid #d3d3d3;border-radius:5px" id="sea"><span class="glyphicon glyphicon-search"></span></p>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Message </h4>
        </div>
        <div class="modal-body">
          <form role="form"  action=<?php echo base_url('MsgPortal/sendmsg/'); ?> method="post" >
    <div class="form-group">
      <label for="person">To:</label>
      <input type="text" name="to" class="form-control" id="to" placeholder="Enter User Name" required>
    </div>
    <div class="form-group">
      <label for="sub">Subject:</label>
      <input type="text" class="form-control" name="sub" id="subj" placeholder="Enter Subject" required>
	  </div>
	   <div class="form-group">
	  <label for="mbody">Message Body:</label>
      <textarea class="form-control" name="body" id="mb" placeholder="Start Typing" required></textarea>
    </div>
    
	<br>
    <button type="submit" class="btn btn-success" value="Send">Send</button>
	<button type="reset" class="btn btn-warning" value="Reset">Reset</button>
  </form>
   </div>
      </div>
      
    </div>
  </div>

<?php

if($this->session->userdata('conversation')!=null)
{
echo "<script type='text/javascript'>

    $(window).load(function(){

        $('#myModal1').modal('show');
		 
    });
</script>";
$temp=$this->session->userdata('conversation');
 $this->session->set_userdata('conversation2',$temp); 
$this->session->unset_userdata('conversation');

}
?> 



<div class="modal fade" id="myModal1" role="dialog" onload="scroll()">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo "Chat Buddy-".$this->session->userdata('conversation2');?> </h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" >
		  <div class="form-group">
      <input type="text" class="form-control" name="subser" id="subser" placeholder="Filter by Subject">
	  </div>
		  <div  id="chbox" class="form-group" style="border:1px solid #d3d3d3;border-radius:5px;float:left;overflow-y:auto;width:570px;height:400px" >
      <?php 
	  $temp_time="0000-00-00 00:00:00";
	  if($this->session->userdata('perdel')!=null)
	  {
		  foreach($this->session->userdata('perdel') as $see)
		  {
			  if($see->ID==$this->session->userdata('mail') && $see->Person==$this->session->userdata('conversation2'))
			  {
				  $temp_time=$see->Del_Time;
			  }
		  }
	  }
	  foreach($this->session->userdata('viewchat') as $cview)
	  {
		  if($cview->ID!=$this->session->userdata('mail') && $cview->Date_Time>$temp_time)
		  {
		  echo "<p align='right'  style='background-color: #addfad'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
		 
		  }
		  else if($cview->Person!=$this->session->userdata('conversation2') && $cview->Date_Time>$temp_time)
		  {
			  
			  echo "<p align='right'  style='background-color: #addfad'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
			
		  }
		 else if($cview->Person==$this->session->userdata('conversation2') && $cview->Date_Time>$temp_time)
		  {
			  
			  echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		
		  }
		  else if($cview->ID==$this->session->userdata('mail') && $cview->Date_Time>$temp_time)
		  {
			  
			  echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		 
		  }
		
	  }
	  ?>
	 
	 
	
	  
    </div>
     <div class="form-group">
	 <br>
     <b><h4><strong>Conversation View </strong>(To Send Messages Go To Inbox Tab)</h4></b>
	</div>
	        

  </form>
   </div>
      </div>
      
    </div>
  </div>
<?php echo $this->session->flashdata('msgres'); ?>
<?php

if($this->session->userdata('pdel')!=null)
{
echo "<script type='text/javascript'>

    $(window).load(function(){

        $('#myModal2').modal('show');
		 
    });
</script>";
$temp=$this->session->userdata('pdel');
 $this->session->set_userdata('pdelf',$temp); 
$this->session->unset_userdata('pdel');

}
?> 

      


<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmation</h4>
        </div>
        <div class="modal-body">
          <form role="form"  action=<?php $a=$this->session->userdata('pdelf'); echo base_url('MsgPortal/perdelf/'.$a); ?> method="post" >
    <div class="form-group">
   
<div class="alert alert-warning"><strong><h4>Warning!!</h4></strong>Permanent Delete will result in deletion of all conversation with this Person from all sources and it cannot be restored. Do you want to continue??</div>
    </div>
    </div>
     <div class="modal-footer">
          <button type="submit" class="btn btn-default">Delete</button>
        </div>
  </form>
   </div>
      </div>
	  </div>

















<div id="datashow">
<table class="table table-striped">
    <thead>
      <tr>
 
        <th>Conversation</th>
        <th>Chat Buddy</th>
        <th>Date and Time of Deletion</th>
		<th>Restore</th>
        <th>Permanent Delete</th>
      </tr>
    </thead>
   <?php
	
   foreach($this->session->userdata('delshow') as $show)
{
	if($show->Date_Time!="0000-00-00 00:00:00" && $show->ID==$this->session->userdata('mail'))
echo "<tr>"."<td><a href='".base_url('MsgPortal/convo/'.$show->Person.'/D')."'>"."View Conversation"."</a></td>"."<td>".$show->Person."</td>"."<td>".$show->Date_Time."</td>"."<td><a href='".base_url('MsgPortal/rest/'.$show->Person)."'><button type='button' class='btn btn-default' data-toggle='tooltip' data-placement='right' title='This will restore back your conversation with this person in all sections' id='delbutt' >"."Restore"."</button></td>"."<td><a data-toggle='modal' href='".base_url('MsgPortal/perdelcon/'.$show->Person)."'><button type='button' class='btn btn-default'>"."Permanent Delete"."</button></td>"."</tr>";
}







?>
  </table>
  
</div>
</body>
<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

$("#sea").keyup(function(){
	
  var chatter=document.getElementById("sea");
  $.ajax({
		url : '<?php echo base_url('MsgPortal/searconvodel/'); ?>',
		type : 'POST',
		data : {
			check:chatter.value,
			},
		
		success:function(data){
			
			
		$('#datashow').html(data);
		
		},
error : function(jqXHR, textStatus, errorThrown){
		}		
	}); 
   

});

$("#subser").keyup(function(){
	
  var chatter1=document.getElementById("subser");
  $.ajax({
		url : '<?php echo base_url('MsgPortal/subfil/'); ?>',
		type : 'POST',
		data : {
			check1:chatter1.value,
			},
		
		success:function(data){
			
			
		$('#chbox').html(data);
		
		},
error : function(jqXHR, textStatus, errorThrown){
		}		
	}); 
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
});














</script>
</html>
