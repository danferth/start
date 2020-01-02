<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Quick Order | Admin';
  $description    = 'Restricted admin console';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = true;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  $generatedPassword = generatePassword();
?>

<!-- START -->
<div class="page-wrap row">

  <div class="col-sm-12">
    <h1>Admin Page</h1>
  </div>

  <div class="col-sm-12 col-lg-7 mb-3 mb-lg-0">
    <div class="card h-100">
      <h2 class='h4 bg-dark text-white card-title card-header'>Add Single User</h2>
    <div class="card-body">
    <form id="formAddUser" class="watchRequired" action="assets/build/db/_adduser.php" method="post">
      <div class="form-row">

        <div class="form-group col-12 col-sm-6 col-md-6">
          <input class='form-control lineInput' type="text" name="Fname" placeholder="First Name" required>
        </div>

        <div class="form-group col-12 col-sm-6 col-md-6">
          <input class='form-control lineInput' type="text" name="Lname" placeholder="Last Name" required>
        </div>

        <div class="form-group col-12 col-sm-6 col-md-8">
          <input class='form-control lineInput' type="email" name="username" placeholder="User (email)" required>
        </div>

        <div class="form-group col-12 col-sm-6 col-md-4">
          <input class='form-control lineInput' type="text" name="custID" placeholder="Cust ID" required>
        </div>

        <div class="form-group col-12 col-sm-6">
          <input class='form-control lineInput' type="password" id="password" name="password" pattern="<?php echo $passwordRegEx; ?>" placeholder="Password" value="<?php echo $generatedPassword; ?>" required>
        </div>

        <div class=" col-12 col-sm-6 align-self-center">
          <p><i class='fa fa-lock text-muted'></i> Auto Password: <b><?php echo $generatedPassword; ?></b></p>
        </div>

        <div class="form-group col-12 col-sm-6 col-md-6">
          <div class="requestAccount custom-control custom-checkbox">
            <input class='requestAccountTrigger custom-control-input' id="isAdmin" type="checkbox" name="isAdmin">
            <label class='custom-control-label' for="isAdmin">Will user be Admin?</label>
          </div>
        </div>

        <div class="form-group col-12 col-sm-6 col-md-6">
          <button class="btn btn-primary btn-block buttonLoader" type="submit" name="submit">Add User</button>
      </div>
    </div>
  </form>
  </div>
  </div>
  </div>


<!-- To setup multiple users in one go use the Add multiple users box and format as:

CSV from client follows this form
fname,lname,email,custID,Password,admin
Linda,Woo,lwoo@cynergy.com,SIN009,i14X0;QxtG,FALSE

use
http://www.convertcsv.com/csv-to-json.htm
to convert to json then copy paste


You can also just create the json like so
[
 {
   "fname": "Linda",
   "lname": "Woo",
   "email": "lwoo@cynergy.com",
   "custID": "SIN009",
   "Password": "1121Dc()",
   "admin": false
 }
]

  -->

  <div class="col-sm-12 col-lg-5 mb-3 mb-lg-0">
    <div class="card h-100">
      <h2 class='h4 bg-dark text-white card-title card-header'>Add Multiple Users</h2>
    <div class="card-body">
    <form class="multipleUsers" id='formMultipleUsers' action="assets/build/db/_add_multiple_user.php" method="post">

      <div class="form-row">
        <div class="form-group col-sm-12">
          <textarea class='form-control multipleUser lineInput' name="inputMultipleUsers" rows="5" cols="80" placeholder="copy/paste users in JSON format"></textarea>
        </div>
        <div class="form-group col-sm-12 mt-md-2">
          <button class='btn btn-primary btn-block buttonLoader' type="submit" name="multipleSubmit">Add Multiple Users</button>
        </div>
      </div>

    </form>
    </div>
    </div>
  </div>



  <div class="admin_user_list col-sm-12 col-md-12 mt-lg-4">
    <div class="card">
      <h2 class='h4 bg-dark text-white card-title card-header'>Users</h2>
      <div class="table-responsive">

    <table class="adminUsersTable table table-sm table-light table-hover">
      <thead class='thead-light'>
        <tr>
          <th class='text-center'><i class='fa fa-user-times text-black'></i></th>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Company</th>
          <th>Cust #</th>
          <th>Setup?</th>
          <th class='d-none d-md-table-cell'>Last Login</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_SESSION['secure']) && $_SESSION['admin'] === 1){
          $q = $db->query("SELECT ID,Fname,Lname,user,customerID,prefShipContact_bizName,setupCompletion,admin,lastLogin FROM users");
          while ($users = $q->fetch()) {
            if(!$users['admin']){
              echo "<tr>
                      <td><button class='btn btn-sm btn-danger btn-block deleteUser' data-userID='".$users['ID']."'><i class='fa fa-minus-circle'></i></button></td>
                      <td>".$users['ID']."</td>
                      <td><a href='view-user.php?id=".$users['ID']."'>".$users['Fname']." ".$users['Lname']."</a></td>
                      <td>".$users['user']."</td>
                      <td>".$users['prefShipContact_bizName']."</td>
                      <td>".$users['customerID']."</td>
                      <td>".yesno($users['setupCompletion'])."</td>
                      <td class='d-none d-md-table-cell'>".$users['lastLogin']."</td>
                      </tr>";
                    }
                  }
                  $q->closeCursor();
                }
                ?>
      </tbody>
    </table>
  </div>
</div>
</div>

</div>


<!-- END -->
<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = "formAddUser";
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
