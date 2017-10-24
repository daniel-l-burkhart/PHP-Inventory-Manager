<?php
  require_once('../includes/load.php');

  validate_access_level(2);
?>
<?php
  $d_sale = find_record_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing sale id.");
    redirect_to_page('sales.php');
  }
?>
<?php
  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","sale deleted.");
      redirect_to_page('sales.php');
  } else {
      $session->msg("d","sale deletion failed.");
      redirect_to_page('sales.php');
  }
?>
