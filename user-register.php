<?
include 'connect/connect.php';
$err = [];
    
$username = $_POST['usrname'];
$first_name = $_POST['fname'];
$mid_name = $_POST['mname'];
$last_name = $_POST['lname'];
$mail = $_POST['mail'];
$password = $_POST['passwd'];

if(!preg_match("/^[a-zA-Z0-9]+$/",$username))
{
    $err[] = "Логин может состоять только из букв английского алфавита и цифр";
}

if(strlen($username) < 5 or strlen($username) > 30)
{
    $err[] = "Логин должен быть не меньше 5-х символов и не больше 30";
}

$query = mysqli_query($link, "SELECT user_id FROM users WHERE username='".mysqli_real_escape_string($link, $username)."'");
if(mysqli_num_rows($query) > 0)
{
    $err[] = "Пользователь с таким логином уже существует.";
}

if(count($err) == 0)
{   
    mysqli_query($link,"INSERT INTO users SET username='".$username."', password='".$password."', first_name='".$first_name."', mid_name='".$mid_name."', last_name='".$last_name."', mail='".$mail."'");
    $out = json_encode(array(
        name => $first_name));
    echo $out;
}
else
{
    foreach($err AS $error)
    {
        $err_arr = $error."<br>";
    }
    $out = json_encode(array(
        error => $err_arr));
    echo $out;
}
?>