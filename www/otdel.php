<!doctype html>
<html lang="ru">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/af06815fdc.js"></script>

	<title>Exchange currency</title>
</head>

<body>

	<?php
	require_once "../db.php"; // подключаем файл для соединения с БД
	session_start();
	?>

	<header>
		<nav class="navbar navbar-expand-md navbar-light bg-light">
			<a class="navbar-brand" href="intro.php">
				<img src="logo.png" style="width:54px;">
				ExchCurrency
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="intro.php">Главная</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="kursval.php">Курсы валют</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="otdel.php">Отделения</a>
					</li>
					<li class="nav-item mr-3">
						<!-- Если авторизован выведет логин -->
						<?php if (isset($_SESSION['auth'])) : ?>
							<?php include_once '../phpscripts/oneFromDB.php';
							$login = getDB($_SESSION['auth'], $link); ?>
							<a href="lichkab.php"><?php echo $login['login']; ?></a></br>

							<!-- Пользователь может нажать выйти для выхода из системы -->
							<a href="../logout.php">
								<center>Выйти</center>
							</a>
						<?php else : ?>

							<!-- Если пользователь не авторизован выведем кнопку на авторизацию -->
							<a href="../login.php" class="btn btn-outline-secondary mr-3">Войти в аккаунт</a>
						<?php endif; ?>
					</li>
				</ul>
				<form class="form-inline">
					<input class="form-control" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-primary" type="submit">Search</button>
				</form>
			</div>
		</nav>
	</header>

	<main>

		<div class="container pb-3 pt-3">
			<div class="row">
				<div class="col-3"></div>
				<div class="col-6 text-center">
					<H1>Точки обслуживания в Волгограде</H1>
				</div>
				<div class="col-3"></div>
			</div>

			<?php
			$result = mysqli_query($link, "SELECT * FROM `otdelenia`");
			$count = mysqli_num_rows($result);
			if ($count >= 1) :
				while ($row = mysqli_fetch_array($result)) { ?>
					<div class="row pt-3">
						<div class="col">
							<h4><?php echo $row['name'] ?>
								<?php if (isset($_SESSION["auth"])) : ?>
									<a href="../phpscripts/otdelDelete.php?delOtdel_id=<?php echo $row['id']; ?>" class="btn fa fa-trash" style="color:blue;"></a>
									<a href="../phpscripts/otdelCorrect.php?correctOtdel_id=<?php echo $row['id']; ?>" class="btn fa fa-cog" style="color:blue;"></a>
								<?php endif; ?>
							</h4>
							<p class="pt-0 text-center"> Адрес: <?php echo $row['address'] ?> </p>
							<p class="pt-0 text-center"> Контактный телефон: <?php echo $row['phone'] ?> </p>
						</div>
						<div class="col">
							<h6>Режим работы: </h6>
							<p class="pt-0 text-center"> <?php echo $row['rezhim_raboty'] ?> </p>
						</div>
					</div>
					<div class="row">
						<p><strong>Сотрудники отделения: </strong></p>
					</div>
					<?php
					$result_query = mysqli_query($link, "SELECT * FROM sotrudniki WHERE otdel_ID = '" . mysqli_real_escape_string($link, $row['id']) . "'");
					$count_query = mysqli_num_rows($result_query);
					$n = 1;
					if ($count_query >= 1) :
						while ($str = mysqli_fetch_array($result_query)) { ?>
							<div class="row mt-4">
								<div class="media ml-5">
									<img class="mr-3" width="20%" src="../img/sotrudImg/<?php echo $str['image'] ?>">
									<div class="media-body align-self-center">
										<strong> <?php echo $n . '.' . $str['name'] ?> </strong>
										<?php if (isset($_SESSION["auth"])) : ?>
											<a href="../phpscripts/sotrudDelete.php?del_id=<?php echo $str['idSot']; ?>" class="btn fa fa-trash" style="color:blue;"></a>
											<a href="../phpscripts/sotrudCorrect.php?correct_id=<?php echo $str['idSot']; ?>?" class="btn fa fa-cog" style="color:blue;"></a>
										<?php endif; ?>
										<p>Дата рождения: <?php echo $str['birhDate'] ?>
											<br>Дата вступления в нашу команду: <?php echo $str['rabDate'] ?>
											<br>Должность: <?php echo $str['dolzh'] ?> </p>
									</div>
								</div>
							</div>
						<?php $n += 1;
						} ?>

			<?php
					else :
						echo 'Пока в этом отделении не зарегестрированы сотрудники.';
					endif;
					echo '<hr align="center" width="100%" color="Grey" />';
				}
			else :
				echo '<h2>Пока нет доступных отделений.</h2>';
			endif;
			?>
			<div class="row">
				<?php if (isset($_SESSION['auth'])) : ?>
					<div class="col text-center"><a href="../phpscripts/otdelNew.php" class="btn btn-outline-primary">Добавить отделение</a></div>
					<div class="col text-center"><a href="../phpscripts/sotrudNew.php" class="btn btn-outline-primary">Добавить сотрудника</a></div>
				<?php endif ?>
			</div>
		</div>
	</main>
	<?php require_once "../footer.php"; ?>

</body>

</html>