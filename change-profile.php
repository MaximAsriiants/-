<?
session_start();
include 'connect/connect.php';

$_POST['change'] = 'yes';


if ((isset($_POST['fname']) or isset($_POST['lname']) or isset($_POST['mname']) or isset($_POST['address']) or isset($_POST['mail']) or isset($_POST['tel'])) and (isset($_POST['change']))){
    $s='UPDATE users SET';

    if (strlen($_POST['fname']) >= 1){
        $s_add[1] = " first_name='".$_POST['fname']."'";
    } else{
    	$s_add[1] = "";
    }

    if (strlen($_POST['mname']) >= 1){
        $s_add[2] = " mid_name='".$_POST['mname']."'";
    } else{
    	$s_add[2] = "";
    }

    if (strlen($_POST['lname']) >= 1){
        $s_add[3] = " last_name='".$_POST['lname']."'";
    } else{
    	$s_add[3] = "";
    }

    if (strlen($_POST['address']) >= 1){
        $s_add[4] = " address='".$_POST['address']."'";
    } else{
    	$s_add[4] = "";
    }

    if (strlen($_POST['tel']) >= 1){
        $s_add[5] = " tel='".$_POST['tel']."'";
    } else{
    	$s_add[5] = "";
    }


    if (strlen($_POST['mail']) >= 1){
        $s_add[6] = " mail='".$_POST['mail']."'";
    } else{
    	$s_add[6] = "";
    }

    for ($i = 1 ; $i <=  6; ++$i)
    	{
			if (!empty($s_add[$i + 1])){
				$s_add[$i] = $s_add[$i].',';
			} 
    	}

	$s="UPDATE users SET ".$s_add[1].$s_add[2].$s_add[3].$s_add[4].$s_add[5].$s_add[6]." WHERE username = '".$_POST['username']."'";
	$s = str_replace('SET ,','SET ',$s);
    mysqli_query($link,$s);
    //echo "UPDATE users SET ".$s." WHERE username = '".$_POST['username']."'";
    $out = json_encode(array(
        success => 'Успешно'));
    echo $out;
} else {
	$out = json_encode(array(
        error => 'Произошла ошибка, попробуйте позже!'));
	echo $out;
}
?> 