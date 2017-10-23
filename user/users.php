<?php
  $page_title = 'All User';
  require_once('../includes/load.php');
?>
<?php

 validate_access_level(1);
 $all_users = find_all_user();
?>
<?php include_once('../header.php'); ?>

<div class="container">
    <div class="jumbotron">

        <h1> User Management!</h1>
        <h3>Use this page to add, edit or delete users.</h3>
    </div>
</div>

<div class="container">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<br/>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Users</span>
       </strong>
         <a href="add_user.php" class="btn btn-info pull-right">Add New User</a>
      </div>
     <div class="panel-body">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center"">#</th>
            <th>Name </th>
            <th>Username</th>
            <th class="text-center">User Role</th>
            <th>Last Login</th>
            <th class="text-center" >Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>

           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('../footer.php'); ?>
