<?php
include('security.php'); 
include('includes/header.php'); 
include('includes/navbar.php');

?>
<head>
<title>Details Entry</title> 
</head>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label> Subject </label>
                <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
            </div>
            <div class="form-group">
                <label> First Name </label>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label> Last Name </label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label> Phone </label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phoneNumber">
            </div>
            <div class="form-group">
                <label> DOB </label>
                <input type="date" name="dob" class="form-control" placeholder="Enter DOB">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>

            <input type ="hidden" name="usertype" value="admin">
            <div class="form-group">
            <select class="form-control"  name="usertype" aria-label="Default select example" >
              <option selected>Open this select usertype</option>
              <option value="Admin">Admin</option>
              <option value="Class Advisor">Class Advisor</option>
              <option value="Course HandlingFaculty">Course HandlingFaculty</option>
              <option value="Course HandlingFaculty">c</option>
              <option value="Event Coordinator">Event Coordinator</option>
              <option value="Exam Coordinator">Exam Coordinator</option>
            </select>
            </div>
            <div class="form-group">
                <label> address </label>
                <input type="text" name="address" class="form-control" placeholder="Enter address">
            </div> 
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
    </h6>
  </div>

  <div class="card-body">
    <?php

     if(isset($_SESSION['status'])&& $_SESSION['status'] !='')
     {
       echo '<h2> '.$_SESSION['status'].' </h2';
       unset($_SESSION['status']);
     }

    ?>

    <div class="table-responsive">
      <?php
         $connection = mysqli_connect($server_name,$db_username,$db_password,$db_name);
         $query = "SELECT * FROM register";
         $query_run = mysqli_query($connection, $query);


      ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th> Subject </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Phone </th>
            <th> DOB </th>
            <th>Email </th>
            <th>Password</th>
            <th>UserType</th>
            <th> Address </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
          if(mysqli_num_rows($query_run) > 0)
          {
            while($row =mysqli_fetch_assoc($query_run)){
              ?>
 
      
          <tr>
            <td><?php echo $row ['id']; ?> </td>
            <td> <?php echo $row ['username']; ?></td>
            <td> <?php echo $row ['subject']; ?></td>
            <td> <?php echo $row ['firstName']; ?></td>
            <td> <?php echo $row ['lastName']; ?></td>
            <td> <?php echo $row ['phone']; ?></td>
            <td> <?php echo $row ['DOB']; ?></td>
            <td> <?php echo $row ['email']; ?></td>
            <td> <?php echo $row ['password']; ?> </td>
            <td> <?php echo $row ['usertype']; ?> </td>
            <td> <?php echo $row ['address']; ?></td>
            <td>
                <form action="register_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row ['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row ['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
          
          <?php
            }
          }else {
            echo "No Records Found";
          }

        ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>