<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsgPortal extends CI_Controller {

	public function inbox()
	{
		$this->load->model('Msg_model');
		    $this->Msg_model->load_indata($this->session->userdata('mail'));
		$this->load->view('Inbox');
	}
	public function sent()
	{
		$this->load->model('Msg_model');
		    $this->Msg_model->load_sendata($this->session->userdata('mail'));
		$this->load->view('Sent');
	}
	public function replied()
	{
		$this->load->model('Msg_model');
		    $this->Msg_model->load_repdata($this->session->userdata('mail'));
		$this->load->view('Replied');
	}
	public function deleted()
	{
		$this->load->model('Msg_model');
		    $this->Msg_model->load_deldata($this->session->userdata('mail'));
		$this->load->view('Deleted');
	}
	public function loginuser()
	{
		
		$this->load->view('loginuser');
	}
	public function chcklogin()
	{
		$mid=$_POST['mid'];
		$pss=$_POST['pss'];
	
		$this->load->model('Msg_model');
		$a=$this->Msg_model->check($mid,$pss);
		if($a=="Invalid Password" || $a=="Invalid User Name")
		{
			
		$this->session->set_flashdata('msg','<div class="alert alert-danger"><h4><b><center>'.$a.'</center></b></h4></div>');
		redirect('MsgPortal/loginuser');
			
		}
		else
		{
		$this->load->model('Msg_model');
		$a=$this->Msg_model->load_data($mid);
		redirect('MsgPortal/inbox');
		}
	}
	public function enteruser()
	{
		$id=$_POST['id'];
		$pwd=$_POST['pwd'];
			$uname=$_POST['uname'];
		$this->load->model('Msg_model');
		$a=$this->Msg_model->insert($id,$pwd,$uname);
        if($a=="done")
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success"><h4><b><center>You Have Successfully Registered</b></center></h4></div>');
			redirect('MsgPortal/loginuser');
		}
		else if($a=="email")
		{
						$this->session->set_flashdata('msg','<div class="alert alert-danger"><h4><b><center>Sorry! Email ID Already In Use</center></b></h4></div>');
			redirect('MsgPortal/loginuser');
		}
		else if($a=="username")
		{
						$this->session->set_flashdata('msg','<div class="alert alert-danger"><h4><b><center>Sorry! User Name Already In Use</center></b></h4></div>');
			redirect('MsgPortal/loginuser');
		}
	}
	public function logout()
	{ $this->session->unset_userdata('del');
		$this->session->unset_userdata('name');
		redirect('MsgPortal/loginuser');
		
	}
	public function sendmsg()
	{
		
		$to=$_POST['to'];
		$sub=$_POST['sub'];
		$body=$_POST['body'];
		$this->load->model('Msg_model');
		$a=$this->Msg_model->sendmsg($to,$sub,$body,$this->session->userdata('nameonly'),$this->session->userdata('mail'));
		if($a=="Sender")
		{
			$this->session->set_flashdata('msgsent','<div class="alert alert-danger"><h4><b><center>Sender Receiver Same Individual</center></b></h4></div>');
			redirect('MsgPortal/sent/');
		}
			if($a=="no")
		{
			$this->session->set_flashdata('msgsent','<div class="alert alert-danger"><h4><b><center>Receiver User Name Doesnot Exist</center></b></h4></div>');
			redirect('MsgPortal/sent/');
		}
		if($a=="sent")
		{
				$this->load->model('Msg_model');
		    $this->Msg_model->load_sendata($this->session->userdata('mail'));
			$this->session->set_flashdata('msgsent','<div class="alert alert-success"><h4><b><center>Message Sent!</center></b></h4></div>');
			redirect('MsgPortal/sent/');	
		}
	  if($a=="replied")
		{
			
			$this->load->model('Msg_model');
		    $this->Msg_model->load_repdata($this->session->userdata('mail'));
			$this->session->set_flashdata('msgrep','<div class="alert alert-success"><h4><b><center>Message Replied!</center></b></h4></div>');
			redirect('MsgPortal/replied/');
			
			
			
				//$this->session->set_flashdata('msgsent','<div class="alert alert-danger"><h4><b><center>Oops! Message Not Sent Try Again</center></b></h4></div>');
			//redirect('MsgPortal/sent/');
		}
	}
	public function convo($a,$b)
	{
		$this->session->set_userdata('conversation',$a);
	    $this->load->model('Msg_model');
		    $chat=$this->Msg_model->load_chatdata($this->session->userdata('mail'),$this->session->userdata('conversation'));
			$this->session->set_userdata('viewchat',$chat);
			if($b=='I')
			{
		redirect('MsgPortal/inbox/');
			}
			if($b=='S')
			{
		redirect('MsgPortal/sent/');
			}
			if($b=='R')
			{
		redirect('MsgPortal/replied/');
			}
			if($b=='D')
			{
		redirect('MsgPortal/deleted/');
			}
	}
	public function ajaxconvo()
	{
		
	$this->load->model('Msg_model');
   $check=$_POST['check'];
   $check1=$_POST['check1'];

		

	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		   $chat=$this->Msg_model->load_chatdataupdate($this->session->userdata('mail'),$this->session->userdata('conversation2'),$check,$check1);
	  if($chat)
	  {
	
		 // $this->session->set_userdata('msgsent',"done");
		  $this->load->model('Msg_model');
		  
		   $chk=$this->Msg_model->load_chatdata1($this->session->userdata('mail'),$this->session->userdata('conversation2'));
			
	foreach($chk as $cview)
	{
		  if($cview->ID!=$this->session->userdata('mail'))
		  {
			echo "<p align='right'  style='background-color: #addfad'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
		 
		  }
		  else if($cview->Person!=$this->session->userdata('conversation2'))
		  {
			  
			echo "<p align='right'  style='background-color: #addfad'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
			
		  }
		 else if($cview->Person==$this->session->userdata('conversation2'))
		  {
			  
			 echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		
		  }
		  else if($cview->ID==$this->session->userdata('mail'))
		  {
			  
			  echo "<p align='left'  style='background-color: #87CEFA'>". "<b>".$cview->Msg."</b>"."<br>"."<h7>".$cview->Date_Time."</h7>"."<br>"."<h7><b>Subject-</b>".$cview->Sub."</h7>"."<br>"."</p>";
			  
		 
		  }
	}
		  

	  }

	  }
	  public function logdel($a)
	  {
		
	    $this->load->model('Msg_model');
		    $check=$this->Msg_model->logdel($this->session->userdata('mail'),$a);
			$this->session->set_userdata('delshow',$check);
		/*	foreach($this->session->userdata('delshow') as $show)
			{
				echo $show->Person;
			}*/
			
			redirect('MsgPortal/deleted/');
			
	  }
	  public function rest($a)
	  {
		
		
	    $this->load->model('Msg_model');
		    $check=$this->Msg_model->rest($this->session->userdata('mail'),$a);
			 $this->session->set_userdata('delshow',$check);
			 $this->session->set_flashdata('msgres','<div class="alert alert-success"><h4><b><center>Conversation Restored</b></center></h4></div>');
				redirect('MsgPortal/deleted/');
	  }
	  
	
	public function perdelcon($a)
	{
$this->session->set_userdata('pdel',$a);
redirect('MsgPortal/deleted/');
		
	}
	public function perdelf($a)
	{
	 $this->load->model('Msg_model');
		    $check=$this->Msg_model->delperm($this->session->userdata('mail'),$a);	
			$this->session->set_userdata('perdel',$check);
			redirect('MsgPortal/deleted/');
	}
	public function searconvoinb()
	{
		$pdel=false;
		$del=false;
		$count=0;
		$count1=0;
		$countdel=0;
		$countpdel=0;
	$check=$_POST['check'];
	
		$this->load->model('Msg_model');
   
		$chat=$this->Msg_model->search($this->session->userdata('mail'),$check);
		echo "<table class='table table-striped'><thead><tr><th>Subject</th><th>Message</th><th>Chat Buddy</th><th>Date and Time</th><th>Action</th></tr></thead>";
	
	$flag=0;
   foreach($chat as $show)
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
	 else
	 {
		 $pdel=true;
	      $countpdel++;
			 
			  foreach($chat as $show1)
			  {
				  $count++;
			  }
			 if($check!='' && $count==$countpdel)
		echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
	     else
			 $count=0;
	 }
		 }
		 else
		 {
			 
		    $del=true;

			 $countdel++;
		 
		 $flag=0; 
			foreach($chat as $show1)
			  {
				  $count1++;
			  }
			
			if($check!='' && $count1==$countdel)
		echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>"; 
	     else
			 $count1=0;
			
			
			
			
			
			
			
			
		 }
   }
    if($pdel==true && $del==true && $check!='')
   {
  
				 echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";  
			  
   }
    if($chat==null)
			{
				echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
			}	
	}
   public function searconvosen()
	{
		$count=0;
		$count1=0;
		$countdel=0;
		$countpdel=0;
		$pdel=false;
		$del=false;
		$check=$_POST['check'];
		$this->load->model('Msg_model');
   
		$chat=$this->Msg_model->search1($this->session->userdata('mail'),$check);
		echo "<table class='table table-striped'><thead><tr><th>Subject</th><th>Message</th><th>Chat Buddy</th><th>Date and Time</th><th>Action</th></tr></thead>";
						
	$flag=0;
   foreach($chat as $show)
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
		 else
		 {
			 $pdel=true;
			 		$countpdel++;
			 
			  foreach($chat as $show1)
			  {
				  $count++;
			  }
			 if($check!='' && $count==$countpdel)
		echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
	     else
		  $count=0;
		 
		 }
		 }
		 else
		 {
		 $countdel++;
		 $del=true;
		 $flag=0; 
			foreach($chat as $show1)
			  {
				  $count1++;
			  }
			
			if($check!='' && $count1==$countdel)
			
				echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>"; 
	     else
		 
			 $count1=0;
		 
   }
   }
   if($pdel==true && $del==true && $check!='')
   {
  
				 echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";  
			  
   }
   if($chat==null)
			{
				echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
			}	
   
   
   
	}
   public function searconvorep()
	{
		$pdel=false;
		$del=false;
		$count=0;
		$count1=0;
		$countdel=0;
		$countpdel=0;
		$check=$_POST['check'];
		$this->load->model('Msg_model');
   
		$chat=$this->Msg_model->search2($this->session->userdata('mail'),$check);
		echo "<table class='table table-striped'><thead><tr><th>Subject</th><th>Message</th><th>Chat Buddy</th><th>Date and Time</th><th>Action</th></tr></thead>";
			  
	$flag=0;
   foreach($chat as $show)
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
		 else
		 {
			  $pdel=true;
			 $countpdel++;
			 
			  foreach($chat as $show1)
			  {
				  $count++;
			  }
			 if($check!='' && $count==$countpdel)
		echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
	     else
			 $count=0;
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
		 }
		 }
		 else
		 { $del=true;
			$countdel++;
		 
		 $flag=0; 
			foreach($chat as $show1)
			  {
				  $count1++;
			  }
			
			if($check!='' && $count1==$countdel)
		echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>"; 
	     else
			 $count1=0;
			
		 }
   }
   if($pdel==true && $del==true && $check!='')
   {
  
				 echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";  
			  
   }
    if($chat==null)
			{
				echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
			}	
	}
	public function	searconvodel()
	{
		$check=$_POST['check'];
		$this->load->model('Msg_model');
   
		$chat=$this->Msg_model->search3($this->session->userdata('mail'),$check);
		echo "<table class='table table-striped'><thead><tr><th>Conversation</th><th>Chat Buddy</th><th>Date and Time of Deletion</th><th>Restore</th><th>Permanent Delete</th></tr></thead>";
		  foreach($chat as $show)
{
echo "<tr>"."<td><a href='".base_url('MsgPortal/convo/'.$show->Person.'/D')."'>"."View Conversation"."</a></td>"."<td>".$show->Person."</td>"."<td>".$show->Date_Time."</td>"."<td><a href='".base_url('MsgPortal/rest/'.$show->Person)."'><button type='button' class='btn btn-default' data-toggle='tooltip' data-placement='right' title='This will restore back your conversation with this person in all sections' id='delbutt' >"."Restore"."</button></td>"."<td><a data-toggle='modal' href='".base_url('MsgPortal/perdelcon/'.$show->Person)."'><button type='button' class='btn btn-default'>"."Permanent Delete"."</button></td>"."</tr>";
}
 if($chat==null)
			{
				echo "<tr>"."<td colspan='5'>"."<b><h4><center>"."No Conversations Found"."</center></h4></b>"."</td>"."</tr>";
			}	

	}
	public function subfil()
	{
		$count1=0;
		$count=0;
		$check1=$_POST['check1'];
		$this->load->model('Msg_model');
   
		$chat=$this->Msg_model->subser($this->session->userdata('mail'),$this->session->userdata('conversation2'),$check1);
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
		foreach($chat as $cview)
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
		 else if($cview->Date_Time<$temp_time)
		  {
			  $count1++;
			  foreach($chat as $see)
		{
			$count++;
		}
			  
			  if($check1!='' && $count==$count1)
echo "<center><b><h4>"."No conversation with Subject ".$check1."</h4></b></center>";
		 else
			 $count=0;
		  }
		
		
	
		}
		if($chat==null)
		{
			echo "<center><b><h4>"."No conversation with Subject ".$check1."</h4></b></center>";
		}
	}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
/*foreach($chat as $show)
{

 echo "<tr>"."<td>".$show->Sub."</td>"."<td><a href='".base_url('MsgPortal/convo/'.$show->Person.'/I')."'>".$show->Msg."</a></td>"."<td>".$show->Person."</td>"."<td>".$show->Date_Time."</td>"."<td><a href='".base_url('MsgPortal/logdel/'.$show->Person)."'><button type='button' data-toggle='tooltip' data-placement='right' title='This will move your conversation to Deleted section. If you have any conversation with that person later then that shall not be displayed unless you restore it back ' id='delbutt'  class='btn btn-default'>"."Move To Deleted"."</button></td>"."</tr>";
		
}*/
	
	}
	

?>