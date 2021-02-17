<div class='w-75 m-auto'>
	<div class='text-center w-50 m-auto'>
		<form method="post" class="w-50 m-auto p-3 form-horizontal text-center">
			<a href='?edit-data=parts' class='btn btn-primary mt-2 w-100'>Добавить\удалить товары</a>
			<a href='?edit-data=users' class='btn btn-primary mt-2 w-100'>Редактировать пользователей</a>
		</form>
	</div>
</div>


	<div class="w-75 m-auto">
		<form id="edit_part_form" method="post" class="w-50 m-auto p-3 form-horizontal text-center">
		<h4>Добавить букет в таблицу</h4>
		<input type="text" placeholder="Наименование" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Цена" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Количество цветов" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Структура букета" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Категория" name="usrname" class="mt-2 form-control"/>
		<button type="submit" name="login-admin" class="btn btn-primary mt-2 w-100">Добавить</button>
	</form>
		<form id="edit_part_form" method="post" class="w-50 p-5 m-auto p-3 form-horizontal text-center">
			<h4>Удалить букет из таблицы</h4>
			<select class="form-control">
			  <option>ID 1 Букет "Ева"</option>
			</select>
			<button type="submit" name="login-admin" class="btn btn-primary mt-2 w-100">Удалить</button>
		</form>
	</div>

	<div class="w-75 m-auto">
		<form id="edit_part_form" method="post" class="w-50 m-auto p-3 form-horizontal text-center">
			<h4>Добавить комплектующие в таблицу</h4>
			<input type="text" placeholder="Логин" name="usrname" class="mt-2 form-control"/>
			<input type="password" placeholder="Пароль" name="passwd" class="mt-2 form-control"/>
			<button type="submit" name="login-admin" class="btn btn-success mt-2 w-100">Добавить</button>
		</form>
	</div>


<? if ($_GET['edit-data'] == 'products'){
	echo '
	<form id="edit_part_form" method="post" class="w-50 m-auto p-3 form-horizontal text-center">
		<h4>Добавить букет в таблицу</h4>
		<input type="text" placeholder="Наименование" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Цена" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Количество цветов" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Структура букета" name="usrname" class="mt-2 form-control"/>
		<input type="text" placeholder="Категория" name="usrname" class="mt-2 form-control"/>
		<button type="submit" name="login-admin" class="btn btn-success mt-2 w-100">Добавить</button>
	</form>';
}