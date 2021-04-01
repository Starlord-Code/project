<?php
include('security.php');
if (isset($_POST['forgotbtn'])) {
    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $error .="<p>Invalid email address please type a valid email address!</p>";
        } else {
            $sel_query = "SELECT * FROM register WHERE email='".$email."'";
            $results = mysqli_query($connection, $sel_query);
            $row = mysqli_num_rows($results);
            if ($row=="") {
                $error .= "<p>No user is registered with this email address!</p>";
            }
        }
        if ($error!="") {
            echo "<div class='error'>".$error."</div>
       <br /><a href='javascript:history.go(-1)'>Go Back</a>";
        } else {
            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d")+1,
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            $key = md5(2418*2+$email);
            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
            $key = $key . $addKey;
            // Insert Temp Table
            mysqli_query(
                $connection,
                "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
    VALUES ('".$email."', '".$key."', '".$expDate."');"
            );
     
            $message='<p>Dear user,</p>';
            $message.='<p>Please click on the following link to reset your password.</p>';
            $message.='<p>-------------------------------------------------------------</p>';
            $message.='<p><a href="http://LocalHost:8080/SGMC_2/admin/reset_password.php?
    key='.$key.'&email='.$email.'&action=reset" target="_blank">
    http://LocalHost:8080/SGMC_2/admin/reset_password.php
    ?key='.$key.'&email='.$email.'&action=reset</a></p>';
            $message.='<p>-------------------------------------------------------------</p>';
            $message.='<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
            $message.='<p>If you did not request this forgotten password email, no action 
    is needed, your password will not be reset. However, you may want to log into 
    your account and change your security password as someone may have guessed it.</p>';
            $message.='<p>Thanks,</p>';
            $body = $message;
            $subject = "Password Recovery ";
     
            $email_to = $email;
            $subject = 'Testing PHP Mail';
            $message = 'This mail is sent using the PHP mail ';
            $headers = 'From: noreply @ company. com';
            //check if the email address is invalid $secure_check
    
    
            $secure_check= filter_var($to_email, FILTER_SANITIZE_EMAIL);
            if (filter_var($secure_check, FILTER_VALIDATE_EMAIL)) {
                mail($to_email, $subject, $message, $headers);//send email
                echo "<div class='error'>
 <p>An email has been sent to you with instructions on how to reset your password.</p>
 </div><br /><br /><br />";
            } else {
                echo "Invalid input";
            }
        }
    }
}
?>