<?php


//include database.php
include "database.php";
$obj = new Database();

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
    <!--search option -->
    <div class="container my-4">

    <form action="search1.php" method="get">
    <div class="input-group mb-3">
    <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" class="form-control" placeholder="Search Data">
    <button type="submit" class="btn btn-info">Search</button>
    </div>
    </form>
    </div>


    <table class = "table table-bordered">
    <thead>
    <tr class="bg-success text-center">
    <th>S.No</th>
    <th>Title</th>
    <th>Description</th>
    </tr>
    </thead>
    <tbody>
      <?php
      //search data
      if(isset($_GET['search'])){
        $filtervalues = $_GET['search'];
        $data = $obj->searchData($filtervalues);
        }

       if (isset($data)) {
        foreach($data as $items){
          ?>
          <tr class = "text-center">
            <td><?= $items['sno'];?></td>
            <td><?= $items['title'];?></td>
            <td><?= $items['description'];?></td>
          </tr>
          <?php
        }//for each close

      }//if close
      else {
        ?>
        <tr>
          <td colspan="3">No Record Found</td>
        </tr>
        <?php
      }//else close

     ?>
    </tbody>

   </body>
   </html>
