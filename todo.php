<?php
  include 'globe.php';
  include 'half_todo.php';

  function todo() {
    global $msg_JSON, $store_msg, $check_msg, $check_num, $today, $today_file,$my_num;

    $today_file  = fopen("/data/data/com.termux/files/home/code_stuff/today.txt", "r");                                                                                 $today = fgets($today_file);
    $check = $today[0].$today[1].$today[2].$today[3];

    $msg_JSON = `termux-sms-inbox`;
  
    $store_msg = json_decode($msg_JSON, true);
  
    $check_msg = $store_msg['9']['body'];
    $check_num = intval($store_msg['9']['number']);

    if ( $check !== "done" && $check_num == 7068308705 ) {
      
      echo "starting text prompt\n...\n";
      while ( $check_msg !== "done" && $check_num == $my_num ) {
	`termux-sms-send -n {$my_num} {$today}`;
        sleep(30);
	half_todo();
      }
      echo "task complete!\n";
      `sed -i 's/^/done /' today.txt`;
    }
    else {
      if ( $check_num == $my_num ) {
        echo "nothing currently scheduled\n"; 
      }
      else {
	echo "unexpected text sent\n...\nresending...\n";
	`termux-sms-send -n {$my_num} starting task list`;
	sleep(10);
	todo();
      }
    }
  }
?>
