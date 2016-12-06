<?php 

if($this->session->userdata('name')==null)
{
redirect('MsgPortal/loginuser/');	
}


 ?>


<?php /* print_r($this->session->userdata('perdel')); */ ?>


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
        <li class="active"><a href=<?php echo base_url('MsgPortal/inbox/'); ?>>Inbox</a></li>
        <li><a href=<?php echo base_url('MsgPortal/sent/'); ?>>Sent</a></li>
        <li><a href=<?php echo base_url('MsgPortal/replied/'); ?>>Replied</a></li>
		<li><a href=<?php echo base_url('MsgPortal/deleted/'); ?>>Deleted</a></li>
	    <li><a href=<?php echo base_url('MsgPortal/logout/'); ?>>Logout</a></li>
		
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
          <form role="form" action=<?php echo base_url('MsgPortal/sendmsg/'); ?>  method="post" >
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
      <textarea class="form-control" name="body" id="mb1" placeholder="Start Typing" required></textarea>
    </div>
    
	<br>
    <button  type="submit" class="btn btn-success"  value="Send">Send</button>
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


<?php
/*if($this->session->userdata('msgsent')!=null)
{
echo "<script type='text/javascript'>
    $(window).load(function(){
        $('#myModal1').modal('show');
    });
</script>";
$this->session->unset_userdata('msgsent');
}*/

?>
 





<div class="modal fade" id="myModal1" role="dialog" onload="scroll()">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo "Chat Buddy-".$this->session->userdata('conversation2');?> </h4>
        </div>
        <div class="modal-body">
          <form role="form" data-toggle="validator" method="post" enctype="multipart/form-data" >
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
		  else if($cview->Person!=$this->session->userdata('conversation2')  && $cview->Date_Time > $temp_time)
		  {
			  
			  echo "<p align='right'  style='background-color: #addfad'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
			
		  }
		 else if($cview->Person==$this->session->userdata('conversation2') && $cview->Date_Time > $temp_time)
		  {
			  
			  echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		
		  }
		  else if($cview->ID==$this->session->userdata('mail') && $cview->Date_Time > $temp_time)
		  {
			  
			  echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		 
		  }
		
	  }
	  ?>
	 
	 
	
	  
    </div>
	 <div class="form-group">
      <input type="text" class="form-control" name="subajax" id="subjajax" placeholder="Enter Conversation Subject">
	  </div>
     <div class="form-group">
      <textarea id="sndmg" class="form-control" name="body23"  placeholder="Start Typing"></textarea>
	
	  </div>
	        <input type="button" id="snd" name="subm" class="btn btn-success" value="Send"></button>
	<button type="reset" name="rese" class="btn btn-warning" value="Reset">Reset</button>

  </form>
   </div>
      </div>
      
    </div>
  </div>























<div id="datashow">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Subject</th>
        <th>Message</th>
        <th>Chat Buddy</th>
        <th>Date and Time</th>
        <th>Action</th>
      </tr>
    </thead>
	<?php
	
	  
	  
	  
	$flag=0;
   foreach($this->session->userdata('inbox') as $show)
   {
	   foreach($this->session->userdata('delshow') as $show1 )
       {
		 if($show1->Person==$show->Person && $show1->ID==$show->ID)   
		 {
			 $flag=1;
			 break;
		 }
	   }
		 if($flag==0)
		 {
		$temp_time="0000-00-00 00:00:00";
		if($this->session->userdata('perdel')!=null)
		{
			
		  foreach($this->session->userdata('perdel') as $see)
		  {
			  if($see->ID==$show->ID && $see->Person==$show->Person)
			  { 
		          
				  $temp_time=$see->Del_Time;
			  }
		  }
		 }
	  
	  if($show->Date_Time>$temp_time)
	  {
echo "<tr>"."<td>".$show->Sub."</td>"."<td><a href='".base_url('MsgPortal/convo/'.$show->Person.'/I')."'>".$show->Msg."</a></td>"."<td>".$show->Person."</td>"."<td>".$show->Date_Time."</td>"."<td><a href='".base_url('MsgPortal/logdel/'.$show->Person)."'><button type='button' data-toggle='tooltip' data-placement='right' title='This will move your conversation to Deleted section. If you have any conversation with that person later then that shall not be displayed unless you restore it back ' id='delbutt'  class='btn btn-default'>"."Move To Deleted"."</button></td>"."</tr>";

		 }
		 }
		 else
		 {
			$flag=0; 
		 }
   }
?>
  </table>
  
</div>


</body>
<script>
 //setTimeout(function(){
   // location = ''
  // },3000);
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});


$("#sea").keyup(function(){
	
  var chatter=document.getElementById("sea");
  $.ajax({
		url : '<?php echo base_url('MsgPortal/searconvoinb/'); ?>',
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












$('#snd').click(function(){
	

	   var name=document.getElementById("sndmg");
	   var name1=document.getElementById("subjajax");
	   

	    if(name1.value.length==0)
	   {
		   name1.value="Can't Send Message without a Subject";
return false;

		   
	   }
	   else if(name.value.length==0)
	   {
		 name.value="Can't Send an Empty Message";
		 return false;
	   }
	  
	   else
	   {
		  
	$.ajax({
		url : '<?php echo base_url('MsgPortal/ajaxconvo/'); ?>',
		type : 'POST',
		data : {
			check:name.value,check1:name1.value,
			},
		
		success:function(data){
			
			
		$('#chbox').append(data);
		
			document.getElementById("sndmg").value='';
			document.getElementById("subjajax").readOnly=true;
document.getElementById("sndmg").focus();
		},
error : function(jqXHR, textStatus, errorThrown){
		}		
	});
	   }
});

</script>
</html>
