
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php

$server_name = "localhost:3304";
$db_username = "root";
$db_password = "";
$db_name = "adminpanel";

$connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);

if(!$connection)
{
    
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title bg-danger text-white"> Database Connection Failed </h1>
                            <h2 class="card-title"> Database Failure</h2>
                            <p class="card-text"> Please Check Your Database Connection.</p>
                            <a href="../index.php" class="btn btn-primary">Go Back to HomePage  </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}
?>