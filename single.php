<?php
	require("db.php");
	if (!isset($_GET["id"])) {
		echo "<script>
			alert('Вы не выбрали товар');
			location.href = 'index.php';
		</script>";
		exit();
	}
	$id = $_GET["id"];

	$item = $db->query("SELECT * FROM items WHERE id=$id")->fetchAll(2);
	if(count($item) > 0) {
		$item = $item[0];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="single">
	<header>
		<a href="index.php">Назад</a>
	</header>
	<main>
		<section class="info">
			<img src="<?= $item['photo'] ?>" alt="item">
			<h1><?= $item['name'] ?></h1>
			<p><?= $item['description'] ?></p>
		</section>
		<section class="buy">
			<div class="amount">
				<button>+</button>
				<button>1</button>
				<button>-</button>
			</div>
			<h2>$<?= $item['price'] ?></h2>
		</section>
	</main>
</body>
</html>