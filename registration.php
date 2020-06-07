<?php 



include 'database.php';


$error = "";

if(isset($_POST['create'])) {

  

   $firstName = strtolower(trim($_POST['fname']));
   $lastName = strtolower(trim($_POST['lname']));
   $email = strtolower(trim($_POST['email']));
   $password = strtolower(trim($_POST['password']));
   $password = md5($password);

//    $firstname = mysqli_real_escape_string($conn,$firstName);
//    $lastname = mysqli_real_escape_string($conn,$lastName);
//    $email = mysqli_real_escape_string($conn,$email);
//    $password = mysqli_real_escape_string($conn,$password);



/* Expressin régulière : /^[a-zA-Z0-9]*$/ ==> signification : ^ cela veut dire qu'on veut  [a-zA-Z0-9]  au début (s'ils apparaissent au début === vrai) ==>indique le début d'une chaîne
l' * : elle signifie qu'on doit avoir [a-zA-Z0-9] soit 0 fois 1fois ou plusieurs fois
le $: (dollar) : indique la fin d'une chaîne.

*/

   

        //  $sql_first = "SELECT * FROM users WHERE fname_users = '$firstName'";
        //  $sql_last = "SELECT * FROM users WHERE lname_users = '$lastName'";
         $sql_email =  "SELECT * FROM users WHERE email_users = '$email';";

        //  $res_first = mysqli_query($conn, $sql_first) or die(mysqli_error($dbName));
        //  $res_last = mysqli_query($conn, $sql_last) or die(mysqli_error($dbName));
         $res_email = mysqli_query($conn, $sql_email) or die(mysqli_error($dbName));

          if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            $error = "<div class='alert alert-danger'>fill up the fields</div>";

    }   
    //     else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-z]*$/", $firstName) && !preg_match("/^[a-z]*$/", $lastName)) {
    //      $error = "<div class='alert alert-danger'>please fill up </div>";
           

    //    } 
       else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "<div class='alert alert-danger'>your first name can't contain numbers</div>";
           

        }  
         else if(!preg_match("/^[a-z]*$/", $firstName)) {
         $error = "<div class='alert alert-danger'>your first name can't contain numbers</div>";
         

        }  else if(!preg_match("/^[a-z]*$/", $lastName)) {
            $error = " <div class='alert alert-danger'> sorry ... your last name should have just alphabets caracters </div>";

         } 
     
         elseif (mysqli_num_rows($res_email) > 0) {
            $error = " <div class='alert alert-danger'>sorry ... your email is already taken </div>";

         } 
         
         if(!strlen($password) > 6 && !preg_match("/^[a-zA-Z0-9]{:,*,;,<}*$/", $password) ) {
            $error = " <div class='alert alert-danger'>invalid password </div>";
         }
          else {
            $query = "INSERT INTO users(fname_users,lname_users,email_users,password_users) VALUES ('{$firstName}','{$lastName}','{$email}','{$password}')";
            $result = mysqli_query($conn,$query) or die(mysqli_error($dbName));
            echo "saved";
            exit();
         }

         


        }







//    $query = "INSERT INTO users(fname_users,lname_users,email_users,password_users)";
//    $query .=  "VALUES ('$firstName','$lastName','$email','$password')";
//    $result = mysqli_query($conn,$query);

//    if(!$result) {
//        die ('query failed ' . mysqli_error());
//    }






  
   

      
   //error


//      if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
//             echo "L'adresse email '$email_a' est considérée comme valide.";
//         }
//     exit();
// }


?>
 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Perfect Cup - Contact</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    


</head>

<body>



    <div class="brand">The Perfect Cup</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

       <!-- Navigation -->

   <?php include 'navbar.php'; ?>

<!-- END Navigation -->
    
    

  
    <div class="container">

        
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Registration
                        <strong>form</strong>
                    </h2>
                    <hr>
                    <div id="add_err2"> <?php echo $error?> </div>
                    <form  action="registration.php" method="post">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>First name</label>
                                <input type="text" id="fname" name="fname" maxlength="25" class="form-control" >
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Last name</label>
                                <input type="text" id="lname" name="lname" maxlength="25" class="form-control" >
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email Address</label>
                                <input type="email" id="email" name="email" maxlength="25" class="form-control" >
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Password</label>
                                <input type="password" id="password" name="password" maxlength="25" class="form-control" >
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="submit" id="submit" name="create"  class="btn btn-default" value="submit" >
                            </div>
                            <div class="form-group col-lg-12">
                            <a href="login.php" class="btn btn-default">Already a member? Login here</a>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; The Perfect Cup 2019</p>
                </div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>