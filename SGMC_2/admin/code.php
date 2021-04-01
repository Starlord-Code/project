<?php
include('security.php');

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }
}
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertype = $_POST['edit_usertype'];
    $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertype' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}  
if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $usertype = mysqli_fetch_array($query_run);

    if($usertype['usertype'] == "Admin")
    {
        $_SESSION['username'] = $email_login;
        header('Location: dashboard.php');
    }
    else if($usertype['usertype'] == "Class Advisor")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../Class_Advisor_Login.html');
    }
    else if($usertype['usertype'] == "Course HandlingFaculty")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../Course_Handling_Faculty_Login.html');
    }
    else if($usertype['usertype'] == "Course Mentor")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../Course_Mentor_Login.html');
    }
    else if($usertype['usertype'] == "Event Coordinator")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../Grace_Mark_Allocator_Login.html');
    }
    else if($usertype['usertype'] == "Exam Coordinator")
    {
        $_SESSION['username'] = $email_login;
        header('Location: ../Exam_Coordinator_Login.html');
    }
    else
    {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: index.php');
    }
}



?>