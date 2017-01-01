<?php
$host="localhost";
$user="root";
$password="";
$db_name="json_example";

$connect=@mysql_connect($host,$user,$password) or die ("Could not connet to mysql");
$dbconnect=mysql_select_db($db_name,$baglan) or die ("Could not connect DataBase");

@mysql_query("SET NAMES UTF8");
@mysql_query("SET CHARACTER SET utf8");
@mysql_query("SET COLLATON_CONNECTION ='uft8_general_ci'");

class RESULT{
	public $SUCCESSFUL =1;
	public $UNSUCCESSFUL =0;
	public $MISSING_PARAMETER =01;
}

$result = new RESULT();
	
if(isset($_GET["function"])){
	$function = $_GET["function"];
	
	if($function == "getCarsFromDatabase"){
		$query = mysql_query("SELECT * FROM CARS");
		$rows = array();
		while($row = mysql_fetch_assoc($query)) {
			$rows["cars"][] = $row;
		}
		print json_encode($rows,JSON_UNESCAPED_UNICODE);
	}
	if($function == "getPersonsFromDatabase"){
		$query = mysql_query("SELECT * FROM PERSONS"); // 
		$rows = array();
		while($row = mysql_fetch_assoc($query)) {
			$rows["persons"][] = $row;
		}
		print json_encode($rows,JSON_UNESCAPED_UNICODE);
	}
	
	if($function == "addCarToDatabase"){
		if(isset($_GET["brand"]) && isset($_GET["model"]) && isset($_GET["km"])&& isset($_GET["year"]) ){
			$marka =$_GET["brand"];
			$model=$_GET["model"];
			$yil=$_GET["year"];
			$km=$_GET["km"];
			
			$add = mysql_query("INSERT INTO cars(BRAND,MODEL,KM,YEAR) VALUES ('$brand','$model','$km','$year')");
			
			if($add){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}	
	if($function == "addPersonToDatabase"){
		if(isset($_GET["name"]) && isset($_GET["surname"]) && isset($_GET["TCno"])&& isset($_GET["address"])&& isset($_GET["carID"]) ){
			
			$name =$_GET["name"];
			$surname=$_GET["surname"];
			$TCno=$_GET["TCno"];
			$address=$_GET["address"];
			$carID=$_GET["carID"];
			
			$add= mysql_query("INSERT INTO persons(NAME,SURNAME,ADDRESS,TCno,CAR_ID) VALUES ('$name','$surname','$TCno','$address','$carID')");
			
			if($add){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function == "deleteCarFromDatabase"){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			
			$delete = mysql_query("DELETE FROM CARS WHERE ID = '$id'");
			if($delete){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function == "deletePersonFromDatabase"){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			
			$delete = mysql_query("DELETE FROM PRSONS WHERE ID = '$id'");
			if($sil){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function == "updateCarFromDatabase"){
		if(isset($_GET["brand"]) && isset($_GET["model"]) && isset($_GET["km"])&& isset($_GET["year"]) && isset($_GET["id"]) ){
			$id = $_GET["id"];
			$brand =$_GET["brand"];
			$model=$_GET["model"];
			$year=$_GET["year"];
			$km=$_GET["km"];
			
			$update = mysql_query("UPDATE cars SET BRAND='$brand',MODEL='$model',KM='$km',YEAR='$year' WHERE ID = '$id'");
			
			if($update){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function == "updatePersonFromDatabase"){
		if(isset($_GET["name"]) && isset($_GET["surname"]) && isset($_GET["TCno"])&& isset($_GET["address"])&& isset($_GET["carID"]) && isset($_GET["id"]) ){
			$id = $_GET["id"];
			$name =$_GET["name"];
			$surname=$_GET["surname"];
			$TCno=$_GET["TCno"];
			$address=$_GET["address"];
			$carID=$_GET["carID"];
			
			$update = mysql_query("UPDATE persons SET NAME='$name',SURNAME='$surname',ADDRESS='$address',TCno='$TCno',CAR_ID='$carID' WHERE ID='$id'");
			
			if($update){
				$array = array("result"=>$result->SUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}else{
				$array = array("result"=>$result->UNSUCCESSFUL);
				echo json_encode($array,JSON_UNESCAPED_UNICODE);
			}
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function=="getCarFromDatabase"){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$query = mysql_query("SELECT * FROM CARS where  ID='$id'");
			$rows = array();
			while($row = mysql_fetch_assoc($query)) {
				$rows["car"][] = $row;
			}
			print json_encode($rows,JSON_UNESCAPED_UNICODE);
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
	
	if($function=="getPersonFromDatabase"){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$query = mysql_query("SELECT * FROM PERSONS where  ID='$id'");
			$rows = array();
			while($row = mysql_fetch_assoc($query)) {
				$rows["person"][] = $row;
			}
			print json_encode($rows,JSON_UNESCAPED_UNICODE);
		}else{
			$array = array("result"=>$result->MISSING_PARAMETER);
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
		}
	}
}
