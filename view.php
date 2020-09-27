<?php 
	require "includes/config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<div class="wrapper">
		<?php 
			$views = mysqli_query($connection, "SELECT * FROM `news` WHERE `id` = " . (int) $_GET['id']);

			if ( mysqli_num_rows($views) <= 0) 
			{ ?>
				<header class="header-content">
					<h1 class="header-content__title">
					Статья не существует.
					</h1>
				</header>
				<main class="main-content">
					Запрашиваемая вами статься не существует!
				</main>
				<footer class="footer-content">
					<div class="footer-content__return">
						<a href="news.php">Все новости >></a>
					</div>
				</footer>		
			<?php	
			} else { 
				$view = mysqli_fetch_assoc($views);
			?>
				<header class="header-content">
					<h1 class="header-content__title">
						<?php echo $view['title']; ?>
					</h1>
				</header>
				<main class="main-content">
					<div class="main-content__news_text">
						<?php echo $view['content']; ?>
					</div>
				</main>
				<footer class="footer-content">
					<div class="footer-content__return">
						<a href="news.php">Все новости >></a>
					</div>
				</footer>
			<?php
			}
			?>
	</div>

	<script src="/js/script.js"></script>
</body>
</html>