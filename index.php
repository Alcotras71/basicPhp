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
		<header class="header-content">
			<h1 class="header-content__title">
				<?php echo $config['title']; ?>
			</h1>
		</header>
		<main class="main-content">
			<?php 
				$per_page = 5;
				$page = 1;

				if ( isset($_GET['page']) ) 
				{
					$page = (int) $_GET['page'];
				}

				$total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `news`");
				$total_count = mysqli_fetch_assoc($total_count_q);
				$total_count = $total_count['total_count'];

				$total_pages = ceil($total_count / $per_page);

				if ($page <= 1) {
					$page = 1;
				}

				if ($page > $total_pages) {
					$page = $total_pages;
				}

				$offset = 0;
				
				$offset = ($per_page * $page) - $per_page;

				$news = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `idate` DESC LIMIT $offset,$per_page");
				if (mysqli_num_rows($news) <= 0) {
					echo 'Нет новостей!';
				} else {
					while ( $new = mysqli_fetch_assoc($news)) 
					{ 	
						?>
						<div class="main-content__news">
							<div class="content__news_title">
								<div class="main-content__news_time"><?php echo date("d.m.Y", $new['idate']); ?></div>
								<h2 class="main-content__news_title-content"><a href="view.php?id=<?php echo $new['id']; ?>"><?php echo $new['title']; ?></a></h2>
							</div>
							<div class="main-content__news_text">
								<?php echo $new['announce'] ?>
							</div>
						</div>
						<?php 
					}
				}
				?>
		</main>
		<footer class="footer-content">
				<h2 class="footer-content__title">
					Страницы:
				</h2>
			<?php 
				for ($i = 1; $i <= $total_pages; $i++) 
				{
					?>
						<a href="news.php?page=<?php echo $i; ?>" class="footer-content__button" data-active="<?php echo $i - 1; ?>"><?php echo $i; ?><a>
					<?php 
				}
			?>
		</footer>
	</div>

	<script src="/js/script.js"></script>
</body>
</html>