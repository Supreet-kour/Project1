<?php

//include database.php
include "database.php";
$obj = new Database();

//insert record
if (isset($_POST['submit'])){
$obj->insertRecord($_POST);
}


//update record
if (isset($_POST['update'])) {
$obj->updateRecord($_POST);
}

//Delete Records
if(isset($_GET['deleteid'])){
  $delid = $_GET['deleteid'];
  $obj->deleteRecord($delid);
}

//complete task
 if(isset($_GET['comp_multiple_data'])){
   $all_sno = $_GET['comp_chk'];
   $seperate_all_sno = implode(",",$all_sno);
   $obj->multipleRecords($seperate_all_sno);
 }

//delete multiple data
if(isset($_GET['del_multiple_data'])){
  $all_sno = $_GET['comp_chk'];
  $seperate_all_sno = implode(",",$all_sno);
  $obj->deleteMultiple($seperate_all_sno);
}

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <title>To Do List</title>

</head>
  <body>
    <h1 class="text-center text-info">To Do List</h1><br>
    <div class="container my-4">
        <?php
        //fetch record for updation
        if (isset($_GET['editid'])){
          $editid = $_GET['editid'];
          $myrecord = $obj->displayRecordBySno($editid);
         ?>
         <!-- Update Form-->
         <form action="index.php" method="post">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?php echo $myrecord['title']; ?>" >
            </div>

            <div class="form-group">
              <label for="desc">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"><?php echo $myrecord['description']; ?></textarea>
            </div>

            <div class="form-group">
            <input type="hidden" name="hid" value="<?php echo $myrecord['sno']; ?>">
            <input type="submit" class="btn btn-info" name="update" value="Update">
            </div>

          </form>
         <?php
       }  //if close
           else{
          ?>
       <form action="index.php" method="post">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>

          <div class="form-group">
          <input type="submit" class="btn btn-info" name="submit" value="Submit">
          </div>

        </form>
      <?php } //else close ?>

        <!--search option -->
        <div class="container my-4">

        <form action="search1.php" method="get">
        <div class="input-group mb-3">
      <!--  <input type="text" name="search" value="<?php //if(isset($_GET['search'])){echo $_GET['search'];}?>" class="form-control" placeholder="Search Data"> -->
        <button type="submit" class="btn btn-info">Search</button>
        </div>
        </form>
        </div>

        <br>
        <h2 class ="text-center text-dark">Display Records</h2>

        <table class = "table table-bordered">
          <tr class="bg-success text-center">
            <th>S.No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Checkbox</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <form action="#" method="">

          <?php
          //display Records
          $data = $obj->displayRecord();
          $sno = 1;
          foreach($data as $value){
            $completed = $value['status'] ;

            if($completed){
              $check_btn_status = 'checked';
            }
            else{
              $check_btn_status = '';
            }
          ?>
          <tr class="text-center">
          <td><?php echo $sno++; ?></td>
          <td><?php
          if($completed){
          echo "<span style='color:red;'</span>";} echo $value['title'];?></td>
          <td><?php
          if($completed){
          echo "<span style='color:red;'</span>";} echo $value['description'];?></td>

         <td><input type='checkbox' name='comp_chk[]' value="<?php echo $value['sno'];?>"
        <?php
        echo $check_btn_status;
        ?>
        </td>

                  <?php
                   if(!$completed){
                  $editbtn = "<td> <a href='index.php?editid=".$value['sno']."'>Edit</a></td>";
                    }

                     else{
                      $editbtn = "<td></td>";
                    }

                    echo $editbtn;
                    ?>
                    <td><a href="index.php?deleteid=<?php echo $value['sno']; ?>" class="btn btn-danger">Delete</a></td>

        <!--  <td>
          <a href="index.php?editid=<?php //echo $value['sno']; ?>" class="btn btn-info">Edit</a>
          <a href="index.php?deleteid=<?php //echo $value['sno']; ?>" class="btn btn-danger">Delete</a>
        </td> -->
          </tr>
          <?php
        }
        //foreach close
           ?>
        </table>
      </div>
      <hr>
      <div class="container">
          <button  class='btn btn-lg btn-warning' name="comp_multiple_data" value="" >Completed</a>
      </div>
      <hr>
      <div class="container">
      <button  class='btn btn-lg btn-danger' name="del_multiple_data" value="" >Delete</a>
      </form>
    </div>

  </body>
</html>
