<?php
  require_once 'config.php';
  //set title and description for page
  $title          = 'Admin';
  $description    = 'Admin page, for adding and deleting users';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = true;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x align-center" >
  <div class="cell small-12">
    <h3>Admin</h3>
    <p>Must be admin to see this page<i class="fa fa-smile-o"></i></p>
  </div>

  <div class="cell small-8">
    <h3>Add a user</h3>
    <form id="formAddUser" class="" action="assets/build/db/_adduser.php" method="post">
      <input type="text" name="Fname" placeholder="first name" required>
      <input type="text" name="Lname" placeholder="last name" required>
      <input type="text" name="username" placeholder="user (email)" required>
      <input type="password" name="password" placeholder="password" required>
      <input type="password" name="passwordConfirm" placeholder="confirm password" required>
      <input type="text" name="custID" placeholder="customer ID" required>
      <label for="isAdmin">Will user have Admin privileges? <input id="isAdmin" type="checkbox" name="isAdmin"></label>
      <input class="button" type="submit" name="submit" value="Add User">
    </form>
    <div class="admin_user_list">
      <p>list of users</p>

      <table>
        <thead>
          <tr>
            <th>delete</th>
            <th>ID</th>
            <th>name</th>
            <th>user name</th>
            <th>Company</th>
            <th>Cust #</th>
            <th>setup</th>
          </tr>
        </thead>
          <tbody>

      <?php
      if(isset($_SESSION['secure']) && $_SESSION['admin'] === 1){

        $q = $db->query("SELECT ID,Fname,Lname,user,customerID,prefShipContact_bizName,setupCompletion,admin FROM users");


        while ($users = $q->fetch()) {
          if(!$users['admin']){
            $setup = yesno($users['setupCompletion']);
            echo $setup;
            echo "<tr>
                    <td><button class='button deleteUser' data-userID='".$users['ID']."'>Delete</button></td>
                    <td>".$users['ID']."</td>
                    <td>".$users['Fname']." ".$users['Lname']."</td>
                    <td>".$users['user']."</td>
                    <td>".$users['prefShipContact_bizName']."</td>
                    <td>".$users['customerID']."</td>
                    <td>".yesno($users['setupCompletion'])."</td>
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
<!-- END -->
<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = "formAddUser";
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
