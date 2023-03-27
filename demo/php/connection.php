<?php
class dbconn
{
	function linkDB(){
		$link=mysqli_connect("localhost","root","","demo");
		if(!$link){
			echo error_reporting(E_ALL);

		}
		else{
			return $link;
		}
	}
	public function loginCheck(){
		$link=$this->linkDB();
		$sql="select *, count(id) from login where Username='".$_POST['Username']."'";
	
		$result=mysqli_query($link,$sql);
		if(!$result){
			echo"ERROR TO CONNECT TABLE";
			}
		while($row=mysqli_fetch_assoc($result)){
			if($row['count(id)']==0){
				return ["status"=>"UNA"];
			}else{
				if($row['Password']==md5($_POST['Password'])){
					return ["status"=>"login"];

				}else{
					return ["status"=>"PW"];
				}
			}
		}
	}
	public function addNewUser(){
		$link=$this->linkDB();
		$sql="INSERT INTO `login`(`Name`, `email_id`, `password`, `Contact_No`) VALUES ('".$_POST['Name']."','".$_POST['email_id']."','".md5($_POST['password'])."','".$_POST['cno']."')";
		$result=mysqli_query($link,$sql);
		if(!$result){
			echo "Error to connect table";
		}
		else{
			return ["status"=>"Done"];
		}
	}

}



?> 
