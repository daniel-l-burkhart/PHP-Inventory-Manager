<?php
  require_once('../includes/load.php');

  validate_access_level(2);
?>
<?php
  $product = find_record_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("danger","Missing Product id.");
    redirect_to_page('product.php');
  }
?>

<?php
  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
      $session->msg("success","Products deleted.");
      redirect_to_page('product.php');
  } else {
      $session->msg("danger","Products deletion failed.");
      redirect_to_page('product.php');
  }
?>
