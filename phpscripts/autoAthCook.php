<?php
// Создаем переменную для сбора данных от пользователя по методу POST

	/*
		Если пользователь не авторизован (проверяем по сессии) -
		тогда проверим его куки, если в куках есть логин и ключ,
		то пробьем их по базе данных.
		Если пара логин-ключ подходит - пишем авторизуем пользователя.

		Если пользователь авторизован - ничего не делаем. 

		Если пустая переменная auth из сессии ИЛИ она равна false (для авторизованного она true).
	*/
	if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) 
	{
		//Проверяем, не пустые ли нужные нам куки...
		if ( !empty($_COOKIE['login']) and !empty($_COOKIE['key']) ) 
		{
			//Пишем логин и ключ из КУК в переменные (для удобства работы):
			$login = $_COOKIE['login']; 
			$key = $_COOKIE['key']; //ключ из кук (аналог пароля, в базе поле cookie)

			//Выбираем из таблицы БД строку с нашим логином 
			$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login' AND cookie='$key' LIMIT 1");
			$res = mysqli_fetch_array($result);

			//Если база данных вернула не пустой ответ - значит пара логин-ключ к кукам подошла...
			if (!empty($res)) 
			{
				//Пишем в сессию информацию о том, что мы авторизовались:
				$_SESSION['auth'] = $res['id']; 

			}
		}
    }
?>