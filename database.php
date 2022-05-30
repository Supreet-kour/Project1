<?php

class Database{

private  $servername = "localhost";
private  $username = "root";
private  $password = "";
private  $database = "notes";
private $conn;


//construct function
function __construct(){
  $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->database);
  if ($this->conn->connect_error) {
    echo "Connection failed";
  }
  else {
    return $this->conn;
  }
}//constructor close


//function to insert records
public function insertRecord($post){
  $title = $post['title'];
  $description = $post['description'];
  $sql = "INSERT INTO `list` (`title`, `description`) VALUES ('$title', '$description')";
  $result = $this->conn->query($sql);
  if ($result) {
    header('location:index.php?msg=ins');
  }else {
    echo "Error ".$sql."<br>".$this->conn->error;
  }
  }//insert record function close


//function to delete records
public function deleteRecord($delid){
$sql = "DELETE FROM `list` WHERE sno ='$delid'";
$result = $this->conn->query($sql);
if($result){
  header('location:index.php?msg=del');
}
else{
  echo "Error ".$sql."<br>".$this->conn->error;
}
}//delete function closed


//function to delete multiple data
public function deleteMultiple($seperate_all_sno){
 $sql="DELETE FROM `list` WHERE `list`.`sno` IN($seperate_all_sno)" ;
 $result = $this->conn->query($sql);
  if($result)
  {
      header('Location:index.php?msg=multiDel');
  }
  else{
    echo "Error ".$sql."<br>".$this->conn->error;
  }
}//close delete multiple data


//function to update records
public function updateRecord($post){
  $title = $post['title'];
  $description = $post['description'];
  $editid = $post['hid'];
  $sql = "UPDATE `list` SET `title` = '$title' , `description` = '$description' WHERE sno ='$editid'";
  $result = $this->conn->query($sql);
  if ($result) {
    header('location:index.php?msg=ups');
  }else {
    echo "Error ".$sql."<br>".$this->conn->error;
  }
}//update record function close


//function to display records
public function displayRecord(){
  $sql =   $sql = "SELECT * FROM `list`";
  $result = $this->conn->query($sql);
  if ($result->num_rows>0) {
    while($row = $result->fetch_assoc()){
      $data[] = $row;
    }//while close
    return $data;
  }//if close
  else {

  }
}//displayRecord close


//function to display record for updation
public function displayRecordBySno($editid){
  $sql = "SELECT * FROM `list` WHERE sno = '$editid'";
  $result = $this->conn->query($sql);
  if ($result->num_rows==1) {
  $row = $result->fetch_assoc();
  return $row;
} //if close
}//displayRecordBysno close


//function to check multiple data
public function multipleRecords($seperate_all_sno){
$sql = "UPDATE `list` SET `status` = '1'  WHERE `list`.`sno` IN($seperate_all_sno)";
$result = $this->conn->query($sql);

    if($result){
      header('location:index.php?msg=completed');
    }
    else{
      echo "Error ".$sql."<br>".$this->conn->error;
    }
}//multiple function close


//function for Search
public function searchData($filtervalues){
$sql = "SELECT * FROM list WHERE CONCAT(title,description) LIKE '%$filtervalues%' ";
$result = $this->conn->query($sql);
$num_result = $result->num_rows;
if ($num_result>0) {
  while($row = $result->fetch_assoc()){
    $data[] = $row;
}//while close
    return $data;
  //header('location:search.php?msg=search');
}//if close
}//function search close

}//class close
