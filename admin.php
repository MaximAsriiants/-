<? session_start();

include 'connect/connect.php';
if(isset($_POST['exit-admin'])){
	unset($_SESSION['role']);
	session_destroy();
	header('Location: admin.php');
}
		
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="/css/bootstrap.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/navbar.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/cat.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/11528.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/8483.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/stylesheet.css" crossorigin="anonymous"/>
		<link rel="stylesheet" href="/css/owl.carousel.min.css" crossorigin="anonymous">
	</head>
	<body>
	<script src="/js/jquery-3.5.1.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
	<div class='content p-5'>
		<? if ($_SESSION['role'] != '1'){
			echo'
				<form id="register_form" method="post" class="w-25 m-auto p-3 form-horizontal text-center">
					<h4>Авторизация в панель администрирования</h4>
					<input type="text" placeholder="Логин" name="usrname" class="mt-2 form-control"/>
					<input type="password" placeholder="Пароль" name="passwd" class="mt-2 form-control"/>
					<button type="submit" name="login-admin" class="btn btn-success mt-2 w-100">Войти</button>
				</form>';
			} else {
				
			}
		?>
		<? if(isset($_POST['login-admin'])){
		$query = mysqli_query($link,"SELECT * FROM users WHERE username='".mysqli_real_escape_string($link,$_POST['usrname'])."' LIMIT 1");
	    $data = mysqli_fetch_assoc($query);

	    if(($data['password'] === $_POST['passwd']) and ($data['role'] == '1')){
	    	$_SESSION['role'] = $data['role'];
	        $out = '<div class="text-center">Вход выполнен!</div>';
	        include 'modules/admin-panel.php';
	        }

		    else{
		        $out = '<div class="text-center">Вы ввели неверный логин/пароль или не являетесь администратором.</div>';
	        echo $out;
		    }
		}?>
		<form id="register_form" method="post" class="w-25 m-auto p-3 form-horizontal text-center">
			<button type="submit" name="exit-admin" class="btn btn-success mt-2 w-100">Выйти</button>
		</form>	

	</div>
	</body>
</html>