<?php 

  include 'globe.php';

 function half_todo() {                     global $msg_JSON, $store_msg, $check_msg, $check_num;                                                                      $msg_JSON = `termux-sms-inbox`;          $store_msg = json_decode($msg_JSON, true);                                                                                 $check_msg = $store_msg['9']['body'];    $check_num = intval($store_msg['9']['number']);                               
  }

?>
