<?php
$host="localhost";
$user="root";
$password="";
$dbname="curd";
$conn=mysqli_connect($host,$user,$password,$dbname);

#============================
 if(isset($_POST['send'])){
   $username= $_POST['usname'];
    $salary= $_POST['salary'];
    $insert="INSERT INTO users VALUES( null,'$username',$salary)";
   $i= mysqli_query($conn,$insert);
 }
 $select="SELECT * FROM users";
 $sql=mysqli_query($conn,$select);
 #====================
 if(isset($_GET['delete'])){
   $id=$_GET['delete'];
   $delete="DELETE FROM `users` WHERE  id=$id";
   $d=mysqli_query($conn,$delete);
 header("location:index.php");
 }
 #===================
 $name="";
 $salary="";
 $update=false;
 if(isset($_GET['edit'])){
   $update=true;
  $id=$_GET['edit'];
  $update="SELECT*FROM users WHERE id=$id";
  $d=mysqli_query($conn,$update);
  $row=mysqli_fetch_assoc($d);
  $name=$row['name'];
  $salary=$row['salary'];

  if(isset($_POST['edit'])){
    $username= $_POST['usname'];
    $salary= $_POST['salary'];
    $edit="UPDATE users SET name='$username',salary='$salary' WHERE id=$id";
   $i= mysqli_query($conn,$edit);

  }
}


 ?>
 <!-- HTML -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
     <link rel="stylesheet" href="./style.css">
 </head>
 <body>
    <h1 class="text-center"  >CURD User</h1>
    <div class="card text-white bg-dark  container col-lg-6" >
  <div class="card-body">
  <form  method="post">
  <div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label" >Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="usname" value="<?php echo $name?>">
    </div>
   </div>
   <!-- end input -->
   <div class="form-group row">
    <label for="salary" class="col-sm-2 col-form-label">Salary</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="salary"value="<?php echo $salary?>">
    </div>
   </div>
 <?php if($update):?>
  <button class="btn btn-info" name="edit">Update</button>
  
  <?php else :?>
  
  <button class="btn btn-info" name="send">Send</button> 
  <?php endif ?> 
   </form>
</div>
</div>
<!-- table -->
<div class="card text-white bg-dark  container col-lg-6" >
  <div class="card-body">
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Salary</th>
      <th scope="col">Action1</th>
      <th scope="col">Action2</th>
      
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($sql as $data) {?>
    <tr>
      <th scope="row"> <?php echo $data['id'] ?></th>
      <th > <?php echo $data['name'] ?></th>
      <td><?php echo $data['salary'] ?></td>
      <td><a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">Remove</a></td>
      <td><a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a></td>
    </tr>
    <?php }  ?>
     </tbody>
</table>

</div>
</div>
</body>