<?php
 $errors = array();

function make_HTML_compliant($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}

function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = make_HTML_compliant($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." can't be blank.";
      return $errors;
    }
  }
}

function make_alert_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= make_HTML_compliant(uppercase_first_letter($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}

function redirect_to_page($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        if ($permanent === true) {
            header('Location: ' . $url, true, 301);
        } else {
            header('Location: ' . $url, true, 302);
        }
    }

    exit();
}

function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total ){
     $sum += $total['total_selling_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}

function read_date($str){
     if($str) {
         return date('F j, Y, g:i:s a', strtotime($str));
     }
     else {
         return null;
     }
  }

function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}

function uppercase_first_letter($str){
    $val = str_replace('-'," ",$str);
    $val = ucfirst($val);
    return $val;
}
