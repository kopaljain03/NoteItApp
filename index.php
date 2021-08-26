<?php

// INSERT INTO `noteit` (`sno`, `title`, `description`, `dt`) VALUES (NULL, 'woosan ', 'i am wooyoung\'s bf he is mine', '2021-05-05 21:33:56.000000');
$insert=false;
$update=false;
$delete=false;

$servername="localhost";
$username="root";
$password="";                     
$database="noteit";

$conn=mysqli_connect($servername,$username,$password,$database);

if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `noteit` WHERE `noteit`.`sno` = $sno";
  $result=mysqli_query($conn,$sql);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['snoEdit'])){
    $sno=$_POST['snoEdit'];
    $title=$_POST['titleEdit'];
    $description=$_POST['descEdit'];
    $sql="UPDATE `noteit` SET `title` = '$title' , `description` = '$description' WHERE `noteit`.`sno` = $sno";
    $result=mysqli_query($conn,$sql);
    if($result){
      $update=true;
    }
  }
  else{
  $title=$_POST['title'];
  $description=$_POST['desc'];
  $sql="INSERT INTO `noteit` ( `title`, `description`, `dt`) VALUES ( '$title ', '$description', current_timestamp())";
  $result=mysqli_query($conn,$sql);


if($result){
  $insert=true;
}
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">  
   
    
    <title>NoteIt</title>
  </head>
  <body>

<!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
  
</button> -->

<!-- Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/NoteItApp/index.php" method="POST">
        <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="modal-body">
            
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/NoteItApp/index.php" ><img src="noteitlogo.png" alt="NoteIt" height="44px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/NoteItApp/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/phpTutorial/contactusform.php">Contact Us</a>
      </ul>
    </div>
  </div>
</nav>
<!-- Successfully Added!</strong> Your note has been added succesfully -->

<?php
if($insert){
 echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong> Successfully Added!</strong> Your note has been added succesfully.
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
</div>';
}

if($update){
  echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Successfully Updated!</strong> Your note has been updated succesfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
 }

 if($delete){
  echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Successfully Deleted!</strong> Your note has been deleted succesfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>';
 }

?>

<br>
<div class="container ">
<h2>Add Your Notes</h2>

<form action="/NoteItApp/index.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <label for="desc" class="form-label">Note Description</label>
  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>
<br>


<div class="container">
<hr>
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php

$sql="SELECT * FROM `noteit`";
$result=mysqli_query($conn,$sql);
$snoo=1;
while($row=mysqli_fetch_assoc($result)){

  echo "<tr>
  <th scope='row'>". $snoo. "</th>
  <td>" . $row['title']. "</td>
  <td> ". $row['description']."</td>
  <td> <button  class='edit btn btn-sm btn-primary' id=".$row['sno']." >Edit</button> <button  class='delete btn btn-sm btn-primary' id=d".$row['sno']." >Delete</button> </td>
</tr>";
  $snoo++;
}
?>


  </tbody>
</table>
<hr>
</div>
<br>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
      } );
    </script>

    <script>
      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener('click',(e)=>{
          console.log("edit ");
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          desc=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,desc);
          titleEdit.value=title;
          descEdit.value=desc;
          snoEdit.value=e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })

      deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener('click',(e)=>{
          console.log("deleting ");
          sno=e.target.id.substr(1,);
          if(confirm("Are you sure you want to delete the note?")){
            console.log("yes");
            window.location=`/NoteItApp/index.php?delete=${sno}`;
          }
          else
          console.log("no");
          
        })
      })
    </script>

  </body> 
</html>