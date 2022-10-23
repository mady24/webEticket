
<?php
if(empty($_SESSION))session_start();
if(!empty($_POST)){

$cred = '{"login":"'.$_POST['login'].'","password":"'.$_POST['password'].'","app":"MOBILE_APP"}';

 
$ch = curl_init( 'https://api.eticket.sn/eticket/auth/login' );
# Setup request to send json via POST.
curl_setopt( $ch, CURLOPT_POSTFIELDS, $cred );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_HEADER, 1);
# Send request.
$result = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($result, 0, $header_size);
$body = substr($result, $header_size);
$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

curl_close($ch);
// echo substr($header, strrpos($header, 'refresh_token: ' )+15, 268).'<br>';
// echo "\n".strlen("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhcHAiOiJXRUJfQVBQIiwic3ViIjoic3VwZXJhZG1pbiIsInJvbGVzIjpbIlNVUEVSX0FETUlOSVNUUkFUT1IiXSwiaXNzIjoiL2V0aWNrZXQvYXV0aC9sb2dpbiIsInVzZXJTZXNzaW9uQ3JlYXRlZCI6ZmFsc2UsImV4cCI6MTY1MjAwODQ0MH0.Kavu9xRW10ObwIzUcKnF0YHbKerfyDUpOnjJKj1NsTQ").'<br>';
//echo(json_encode($header));

if($http_code === 200){
    echo "Code de la reponse".$http_code;
    $body_array = json_decode($body,true);
    $header_array = explode(":",$header);

    $id = $body_array[0]['id'];
    

    $access_token = str_replace("Expires",'',$header_array[8]) ;
    echo"<br><br>Token ".$access_token;
    echo"Not empty";

    //GET SESSION DATA
    $ch = curl_init( 'https://api.eticket.sn/eticket/auth/getSessionData/'.$id );
    curl_setopt($ch,CURLOPT_URL,'https://api.eticket.sn/eticket/auth/getSessionData/'.$id);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	$header   = array();
	$header[] = 'Authorization: Bearer ' . $access_token;
	$header[] = 'Content-Type:  application/json ';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $session_data = curl_exec($ch);
    curl_close($ch);
    
    $_SESSION['access_token'] = $access_token;
    $_SESSION['user'] = $session_data;
  
    header('location: index.php');

}else{
    echo"<mark>Les données saisies sont incorrectes</mark>";
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="login" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value=" Login">
                                           
                                      
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>