<?
session_start();
include 'connect/connect.php';


if(isset($_POST['usrname']) && isset($_POST['passwd'])){
    $query = mysqli_query($link,"SELECT * FROM users WHERE username='".mysqli_real_escape_string($link,$_POST['usrname'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if($data['password'] === $_POST['passwd']){
        $_SESSION['username']=$_POST['usrname'];
        $_SESSION['name']=$data['first_name'];
        $_SESSION['role']=$data['role'];

        $out = json_encode(array(
			name => $data['first_name'],
			session_role => $data['role'],
			status => $s_status));
		echo $out;
        }

	    else{
	        $out = json_encode(array(
            error => 'Вы ввели неверный логин/пароль'));
        echo $out;
	    }
    }
?>