<?php
  require_once('includes/load.php');
  if(!$session->logout()) {redirect_to_page("index.php");}
?>
