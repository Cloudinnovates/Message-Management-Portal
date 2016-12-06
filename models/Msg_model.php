<?php
 
 
 class Msg_model extends CI_Model
 {
  function __construct()
  {
     parent::__construct();
	 
  }
  function check($a,$b)
  {
	  $query= "select * from loggedusers where id='$a'";
   $result2 = $this->db->query($query);
   $result3 = $result2->result();
if($result3!=null)
 {
	if(md5($b)==$result3[0]->Pass)
	{
	/*$userdata = array('username'=> $result3[0]->name,'email'=> $result3[0]->ID);
			$this->session->set_userdata('name_copy',$result3[0]->ID);		
			$this->session->set_userdata('name',$userdata); */	  

			
		$this->session->set_userdata('name','Welcome '.$result3[0]->name);
		$this->session->set_userdata('nameonly',$result3[0]->name);
		$this->session->set_userdata('mail',$result3[0]->ID);
		return $result3[0]->name;
	}
	else{
		$a="Invalid Password";
		return $a;
		
	}
}
else{
	$b="Invalid User Name";
		return $b;

	
}
	
  }
 
 function insert($a,$b,$c)
  {
	  	  $query2= "select * from loggedusers where id='$a'  ";
   $result2 = $this->db->query($query2);
   $result3=$result2->result();
     $query22= "select * from loggedusers where  name='$c' ";
   $result22 = $this->db->query($query22);
   $result32=$result22->result();
   if($result3!=null)
   {
	   $msg="email";
	   return $msg;
   }
  else if($result32!=null)
   {
	   $msg="username";
	   return $msg;
   }
   else
   {
	  $query1= "insert into loggedusers values('$a',md5('$b'),'$c')";
   $result1 = $this->db->query($query1);
    $query11= "insert into inbox_view(ID) values('$a')";
   $result11 = $this->db->query($query11);
      $query12= "insert into sent_view(ID) values('$a')";
   $result12 = $this->db->query($query12);
      $query13= "insert into replied_view(ID) values('$a')";
   $result13 = $this->db->query($query13);
      $query14= "insert into deleted_view(ID) values('$a')";
   $result14 = $this->db->query($query14);
$msg="done";
   return $msg;
   }
  }
  function sendmsg($a,$b,$c,$d,$e)
  {
 
 
 if($a==$d)
 {
	 $war="Sender";
	 return $war;
 }
  $query0= "select * from loggedusers where name='$a'";
   $result0 = $this->db->query($query0);
    $result1=$result0->result();
	if($result1==null)
	{
		$war1="no";
		return $war1;
	}
 
 $tmp_query= "select * from inbox where ID='$e' and Person='$a'  ";
   $tr1 = $this->db->query($tmp_query);
   $tr2=$tr1->result();
 
 if($tr2==null)
 
 {
  $query1= "select * from loggedusers where name='$a'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$c1=$result2[0]->ID;
	$query3= "insert into inbox values('$c1','$b','$c','$d',sysdate())";
   $result3 = $this->db->query($query3);
  	$query4= "insert into sent values('$e','$b','$c','$a',sysdate())";
   $result4 = $this->db->query($query4);
   $out="sent";
    return $out;
 }
 else
 {
	 $query1= "select * from loggedusers where name='$a'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$c1=$result2[0]->ID;
	$query3= "insert into inbox values('$c1','$b','$c','$d',sysdate())";
   $result3 = $this->db->query($query3);
  	$query4= "insert into replied values('$e','$b','$c','$a',sysdate())";
   $result4 = $this->db->query($query4);
   	$query5= "insert into sent values('$e','$b','$c','$a',sysdate())";
   $result5 = $this->db->query($query5);
 $out="replied";
    return $out;
	 
	 
	 
	 
 }
 
  }
 function load_data($a)
 {
	 
	 
	
	 
 	 $tmp_query= "create view inb as select ID,Msg,Sub,Date_Time,Person from inbox where ID='$a'";
	 $this->db->query($tmp_query);
  $query1="select ID,Msg,Sub,Date_Time,Person from inb where Date_Time in (select max(Date_Time) from inb group by Person)";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	 $tmp_que= "drop view inb";
	 $this->db->query($tmp_que); 
	 
	 
	 
	 
	$tmp_query1= "create view sen as select ID,Msg,Sub,Date_Time,Person from sent where ID='$a'";
	 $this->db->query($tmp_query1);
	 $query3= "select ID,Msg,Sub,Date_Time,Person from sen where ID='$a' and Date_Time in (select max(Date_Time) from sen group by Person)";
   $result3 = $this->db->query($query3);
    $result4=$result3->result();
	$tmp_que1= "drop view sen";
	 $this->db->query($tmp_que1);
	 
	 
	 
	 
	 
	 $tmp_query1= "create view sen as select ID,Msg,Sub,Date_Time,Person from replied where ID='$a'";
	 $this->db->query($tmp_query1);
	 $query35= "select ID,Msg,Sub,Date_Time,Person from sen where ID='$a' and Date_Time in (select max(Date_Time) from sen group by Person)";
   $result35 = $this->db->query($query35);
    $result5=$result35->result();
	$tmp_que1= "drop view sen";
	 $this->db->query($tmp_que1);
	 
	  $query36= "select * from deleted";
   $result36 = $this->db->query($query36);
    $result56=$result36->result();
	 
	  $query136= "select * from pdelete";
   $result136 = $this->db->query($query136);
    $result156=$result136->result();
	 
	 
	 
	 $this->session->set_userdata('inbox',$result2);
	  $this->session->set_userdata('sent',$result4);
	 $this->session->set_userdata('replied',$result5);
	$this->session->set_userdata('delshow',$result56);
	$this->session->set_userdata('perdel',$result156);
 }
  function load_sendata($a)
 {
	
	$tmp_query1= "create view sen as select ID,Msg,Sub,Date_Time,Person from sent where ID='$a'";
	 $this->db->query($tmp_query1);
	 $query3= "select ID,Msg,Sub,Date_Time,Person from sen where ID='$a' and Date_Time in (select max(Date_Time) from sen group by Person)";
   $result3 = $this->db->query($query3);
    $result4=$result3->result();
	$tmp_que1= "drop view sen";
	 	 $this->db->query($tmp_que1);
	  $this->session->set_userdata('sent',$result4);
	 
 }
 
 function load_indata($a)
 {
	  	 $tmp_query= "create view inb as select ID,Msg,Sub,Date_Time,Person from inbox where ID='$a'";
	 $this->db->query($tmp_query);
  $query1="select ID,Msg,Sub,Date_Time,Person from inb where Date_Time in (select max(Date_Time) from inb group by Person)";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	 $tmp_que= "drop view inb";
	 $this->db->query($tmp_que); 
	 $this->session->set_userdata('inbox',$result2);
	  $query136= "select * from pdelete";
   $result136 = $this->db->query($query136);
    $result156=$result136->result();
	$this->session->set_userdata('perdel',$result156);
 }
  function load_deldata($a)
 {
	     $query13= "select * from deleted";
   $result13 = $this->db->query($query13);
    $result14=$result13->result();
	 $this->session->set_userdata('delshow',$result14);
	 	  $query136= "select * from pdelete";
	  $result136 = $this->db->query($query136);
    $result156=$result136->result();
	$this->session->set_userdata('perdel',$result156);
	 
 }
  function load_repdata($a)
 {
	
	$tmp_query1= "create view sen as select ID,Msg,Sub,Date_Time,Person from replied where ID='$a'";
	 $this->db->query($tmp_query1);
	 $query3= "select ID,Msg,Sub,Date_Time,Person from sen where ID='$a' and Date_Time in (select max(Date_Time) from sen group by Person)";
   $result3 = $this->db->query($query3);
    $result4=$result3->result();
	$tmp_que1= "drop view sen";
	 	 $this->db->query($tmp_que1);

		 
	
		 	$tmp_query2= "create view sen as select ID,Msg,Sub,Date_Time,Person from sent where ID='$a'";
	 $this->db->query($tmp_query1);
	 $query5= "select ID,Msg,Sub,Date_Time,Person from sen where ID='$a' and Date_Time in (select max(Date_Time) from sen group by Person)";
   $result15 = $this->db->query($query5);
    $result5=$result15->result();
	$tmp_que1= "drop view sen";
	 	 $this->db->query($tmp_que1);
		 
		 	  $query136= "select * from pdelete";
		 		  $result136 = $this->db->query($query136);
    $result156=$result136->result();
	$this->session->set_userdata('perdel',$result156);
		 
		 
		 
		   $this->session->set_userdata('sent',$result5);
	  $this->session->set_userdata('replied',$result4);
	 
 }
 function load_chatdata($a,$b)
 {
	  $query1= "select ID from loggedusers where name='$b'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$aa=$result2[0]->ID;
	 $query11= "select name from loggedusers where ID='$a'";
   $result11 = $this->db->query($query11);
    $result21=$result11->result();
	$aaa=$result21[0]->name;
	 $query3= "select ID,Sub,Person,Msg,Date_Time from inbox where (id='$a' and Person='$b') or (id='$aa' and Person='$aaa') order by Date_Time";
   $result3 = $this->db->query($query3);
    $result4=$result3->result();
	return $result4;
 }
  function load_chatdata1($a,$b)
 {
	 $query1= "select ID from loggedusers where name='$b'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$aa=$result2[0]->ID;
	 $query11= "select name from loggedusers where ID='$a'";
   $result11 = $this->db->query($query11);
    $result21=$result11->result();
	$aaa=$result21[0]->name;

	$query3= "select ID,Msg,Sub,Person,Date_Time from inbox where Date_Time in (SELECT MAX(Date_Time) from inbox where Date_Time in (select Date_Time from inbox where (id='$a' and Person='$b') or (id='$aa' and Person='$aaa') order by Date_Time))";
   $result3 = $this->db->query($query3);
    $result4=$result3->result();
	return $result4;
 } 
  function load_chatdataupdate($a,$b,$c,$d)
 {
	 	 $query1= "select ID from loggedusers where name='$b'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$aa=$result2[0]->ID;
		 	 $query11= "select name from loggedusers where ID='$a'";
   $result11 = $this->db->query($query11);
    $result21=$result11->result();
	$aaa=$result21[0]->name;
	 $query3= "insert into inbox(ID,Sub,Msg,Person,Date_Time) values('$aa','$d','$c','$aaa',sysdate())";
   $result3 = $this->db->query($query3);
   $query4= "insert into sent(ID,Sub,Msg,Person,Date_Time) values('$a','$d','$c','$b',sysdate())";
   $result4= $this->db->query($query4);
   $query5= "insert into replied(ID,Sub,Msg,Person,Date_Time) values('$a','$d','$c','$b',sysdate())";
   $result5= $this->db->query($query5);
	return true;
 }
 
 function logdel($a,$b)
 {
	 
	$query5= "insert into deleted values('$a','View Conversation','$b',sysdate())";
   $result5 = $this->db->query($query5);
    $query13= "select * from deleted";
   $result13 = $this->db->query($query13);
    $result14=$result13->result();
		 return $result14;
 }
  function rest($a,$b)
 {
	
	
    $query13= "delete from deleted where ID='$a' and Person='$b'";
   $result13 = $this->db->query($query13);
$query135= "select * from deleted";
   $result135 = $this->db->query($query135);
    $result14=$result135->result();
		 return $result14;
 }
 function delperm($a,$b)
 {
	 
	 
	 $query135= "select * from pdelete where ID='$a' and Person='$b'";
   $result135 = $this->db->query($query135);
    $result14=$result135->result();
	 if($result14==null)
	 {
	 $query1= "insert into pdelete values('$a','$b',sysdate())";
   $result1 = $this->db->query($query1);
   
   $query1351= "select * from pdelete";
   $result1351 = $this->db->query($query1351);
    $result141=$result1351->result();
    $query13= "delete from deleted where ID='$a' and Person='$b'";
   $result13 = $this->db->query($query13);
   return  $result141; 
   
	 }
	 else if($result14!=null)
	 {
		  $query1= "update pdelete set Del_Time=sysdate() where ID='$a' and Person='$b'";
   $result1 = $this->db->query($query1);
   
   $query1351= "select * from pdelete";
   $result1351 = $this->db->query($query1351);
    $result141=$result1351->result();
    $query13= "delete from deleted where ID='$a' and Person='$b'";
   $result13 = $this->db->query($query13);
   return  $result141;
		 
	 }
 }
	public function search($a,$b)
	{
		
	  	$tmp_query= "create view inb as select ID,Msg,Sub,Date_Time,Person from inbox where ID='$a'";
	 $this->db->query($tmp_query);
  $query1="create view inb1 as select ID,Msg,Sub,Date_Time,Person from inb where Date_Time in (select max(Date_Time) from inb group by Person)";
   $result1 = $this->db->query($query1);
     $query136= "select * from inb1 where Person like '$b%'";
   $result136 = $this->db->query($query136);
   $result156=$result136->result();
   
	 $tmp_que= "drop view inb";
	 $this->db->query($tmp_que); 
	  $tmp_que1= "drop view inb1";
	 $this->db->query($tmp_que1); 
  return $result156;
	
	
 }
 public function search1($a,$b)
	{
		
	  	$tmp_query= "create view inb2 as select ID,Msg,Sub,Date_Time,Person from sent where ID='$a'";
	 $this->db->query($tmp_query);
  $query1="create view inb3 as select ID,Msg,Sub,Date_Time,Person from inb2 where Date_Time in (select max(Date_Time) from inb2 group by Person)";
   $result1 = $this->db->query($query1);
     $query136= "select * from inb3 where Person like '$b%'";
   $result136 = $this->db->query($query136);
   $result156=$result136->result();
   
	 $tmp_que= "drop view inb2";
	 $this->db->query($tmp_que); 
	  $tmp_que1= "drop view inb3";
	 $this->db->query($tmp_que1); 
  return $result156;
	
	
 }
 public function search2($a,$b)
	{
		
	  	$tmp_query= "create view inb4 as select ID,Msg,Sub,Date_Time,Person from replied where ID='$a'";
	 $this->db->query($tmp_query);
  $query1="create view inb5 as select ID,Msg,Sub,Date_Time,Person from inb4 where Date_Time in (select max(Date_Time) from inb4 group by Person)";
   $result1 = $this->db->query($query1);
     $query136= "select * from inb5 where Person like '$b%'";
   $result136 = $this->db->query($query136);
   $result156=$result136->result();
   
	 $tmp_que= "drop view inb4";
	 $this->db->query($tmp_que); 
	  $tmp_que1= "drop view inb5";
	 $this->db->query($tmp_que1); 
  return $result156;
	
	
 }
	public function search3($a,$b)
	{
		
	  	
     $query136= "select * from deleted where id='$a' and Person like '$b%'";
   $result136 = $this->db->query($query136);
   $result156=$result136->result();
   
	  
  return $result156;
	
	
 }
 public function subser($a,$b,$c)
 {
	 	 $query1= "select ID from loggedusers where name='$b'";
   $result1 = $this->db->query($query1);
    $result2=$result1->result();
	$aa=$result2[0]->ID;
	 $query11= "select name from loggedusers where ID='$a'";
   $result11 = $this->db->query($query11);
    $result21=$result11->result();
	$aaa=$result21[0]->name;
	 $query3= "create view sear as select ID,Sub,Person,Msg,Date_Time from inbox where (id='$a' and Person='$b') or (id='$aa' and Person='$aaa') order by Date_Time";
   $result3 = $this->db->query($query3);
   $qqq="select * from sear where Sub like '$c%'";
   $result33 = $this->db->query($qqq);
    $result4=$result33->result();
	$teque="drop view sear";
	$this->db->query($teque);
	return $result4;
 }
	
	

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 /* function insrow1($p,$p1)
  {
	  $query= "select * from emp_ci where email='$p'";
   $result2 = $this->db->query($query);
   $result3 = $result2->result();
if($result3!=null)
 {
	if($p1==$result3[0]->pass)
	{
		$this->session->set_userdata('name',$result3[0]->name);
		$this->session->set_userdata('id',$result3[0]->email);
		$this->session->set_userdata('phone',$result3[0]->phone);
		$this->session->set_userdata('dob',$result3[0]->dob);
		$this->session->set_userdata('des',$result3[0]->desig);
		$this->session->set_userdata('gen',$result3[0]->gender);
		  $query12= "select * from img where email='$p'";
   $result23 = $this->db->query($query12);
   $result33 = $result23->result();
   $this->session->set_userdata('im',$result33[0]->imp);
   $this->session->set_userdata('item2', $result3[0]->name);
	     return $result3[0]->name;
	}
	else{
		$a="invalid password";
		return $a;
		
	}
}
else{
	$b="invalid username";
		return $b;

	
}
	
  }
  function insrow($data,$target_path,$temp_name)
  {
	   $query3="select * from emp_ci where email='$data[b]'";
   $result2 = $this->db->query($query3);
   $result3 = $result2->result();
   if($result3!=null)
   {
	   return false;
   }
   else
   {
   
   
   $query="insert into emp_ci(name,email,phone,gender,desig,dob,tdate,pass) values('$data[a]','$data[b]','$data[c]','$data[e]','$data[f]','$data[d]','$data[g]','$data[h]')";
   $result = $this->db->query($query); 

$query1="insert into img values('$target_path','$data[b]')";
 $result1 = $this->db->query($query1); 
   
   
  return true;
  }
  
  
  
  }
  
   function insrow2($data,$target_path,$temp_name)
  {
	  
  
   
   
   $query="update emp_ci set name='$data[a]',phone='$data[c]',gender='$data[e]',dob='$data[d]',desig='$data[f]' where email='$data[b]'";
   $result = $this->db->query($query); 

$query1="update img set imp='$target_path' where email='$data[b]'";
 $result1 = $this->db->query($query1); 
     $query13= "select * from img where email='$data[b]'";
   $result24 = $this->db->query($query13);
   $result34 = $result24->result();

   $this->session->set_userdata('im',$result34[0]->imp);

  return true;
  
  
  
  
  }
 
   function viewus()
  {
	  $query= "select * from emp_ci";
   $result2 = $this->db->query($query);
   $result3 = $result2->result();
   return $result3;
  }
  
   function rem($maill)
  {
	  $query= "delete from emp_ci where email='$maill' ";
   $result2 = $this->db->query($query);

   return true;
  }
   function rem1($maill)
  {
	  $query= "delete from emp_ci where email='$maill' ";
   $result2 = $this->db->query($query);

   return true;
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 }*/
  
 
 
 
 }
 ?>