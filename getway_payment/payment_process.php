<?php
session_start(); 
include('db.php');

if(isset($_POST['amount']) && isset($_POST['name'])){
	$amount = $_POST['amount'];
	$name = $_POST['name'];
	$status = "pending";
	$date = date('Y-m-d h:i:s');

	mysqli_query($db,"INSERT INTO payment(name,amount,date_new,status) VALUES ('$name','$amount','$date','$status')");
	$_SESSION['name']= $name;
	$_SESSION['OID']=mysqli_insert_id($db);
}
	

if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
	$payment_id = $_POST['payment_id'];
	
	mysqli_query($db,"update payment set status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");
}
?>