<?php
  require_once('../includes/load.php');

   validate_access_level(1);
?>
<?php
  $delete_id = delete_by_id('users',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","User deleted.");
      redirect('users.php');
  } else {
      $session->msg("d","User deletion failed Or Missing Prm.");
      redirect('users.php');
  }
?>
