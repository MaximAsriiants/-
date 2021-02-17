<? 
session_start();
include '../connect/connect.php';
mysqli_query($link,"DELETE FROM cart WHERE user_id='".$_POST['user_id']."' AND article='".$_POST['article']."'");
$out = json_encode(array(
    success => 'Успешно'));
echo $out
?>