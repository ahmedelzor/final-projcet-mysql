<?php
// connication

$host = "localhost";
$user = "root";
$pass = "";
$db = "crud";


$conn = mysqli_connect( $host,$user,$pass,$db);


// create
if(isset($_POST['send'])){
    $user = $_POST['user'];
    $salery = $_POST['salery'];
    $insert = " INSERT INTO `users` VALUES ( NULL , '$user' , $salery)";
$i = mysqli_query($conn , $insert);
}


// select
$select = "SELECT * FROM users";
$s = mysqli_query($conn , $select);


// update
$user ="";
$salery ="";
$update =false;
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM users where id=$id";
    $su = mysqli_query($conn , $select);
    $row = mysqli_fetch_assoc($su);
    $user = $row['name'];
    $salery = $row['salery'];
    if(isset($_POST['update'])){
        $user = $_POST['user'];
        $salery = $_POST['salery'];
        $Update = " UPDATE users SET name='$user' , salery= $salery where id= $id " ;
       $u = mysqli_query($conn , $Update);
       if($u){
           echo "true";
           header("location: /crud/index.php");
       }else{
           echo "false";
       }
}
}


// // delete

if(isset($_GET['delete'])){
 $id =  $_GET['delete'];
 $delete ="DELETE FROM users WHERE id=$id";
 mysqli_query($conn , $delete);
 header("location: /crud/index.php");
}




?>
<!-- ============================ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYSQL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href ="/crud/index.css">
</head>
<body>

<div class="container col-md-6 my-5">
    <h1 class ="text-center">FINAL PROJECT MYSQL</h1>
    <div class="card">
        <div class="card-body">
            <form method = "POST" >
            <div class="form-group">
                <label>user name   </label>
                <input type="text" value="<?php echo $user?>" name="user" placeholder="user Name" class="form-control">
            </div>
            <div class="form-group">
                <label> salery  </label>
                <input  type="text" name="salery" value="<?php echo $salery?>" placeholder="salery" class="form-control">
            </div>
         
            <div>
                <?php if($update): ?>
                <button name="update" class="btn btn-info w-50 my-3 mx-auto btn-block"> Update Data</button>
                <?php else : ?>
                <button name="send" class="btn btn-info w-50 my-3 mx-auto btn-block"> Sand Data</button>
                <?php endif; ?>
            </div>     
            </form>             
        </div>
</div>
       
        <div class="container col-md-12 my-5 text-center">
            <div class="card">
                <div class="card-body">
                    <table class ="table table-dark">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>SALERY</th>
                            <th colspan="2">ACTION</th>
                        </tr>
                        <?php foreach($s as $data){ ?>
                        <tr>
                            <th> <?php echo $data['id'] ?> </th>
                            <th> <?php echo $data['name'] ?> </th>
                            <th> <?php echo $data['salery'] ?> </th>
                            <th> <a  href="/crud/index.php?edit=<?php echo $data['id'] ?>" class ="btn btn-info mr-2" >Edit</a> </th>
                            <th> <a href="/crud/index.php?delete=<?php echo $data['id'] ?>" class ="btn btn-danger" >Remove</a>  </th>

                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    
</body>
</html>