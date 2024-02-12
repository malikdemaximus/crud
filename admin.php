<?php
	require("db.php");

	if (!empty($_GET)) {
		if(isset($_GET["delete_cat"])) {
			$id = $_GET["id"];

			if ($db -> query("DELETE FROM categories WHERE id=$id")) {
				echo "<script>
					alert('Успешно удалено');
					location.href = 'admin.php';
				</script>";
				exit();
			} else {
				var_dump($db->errorInfo());
			}
		}
		if(isset($_GET["delete"])) {
			$id = $_GET["id"];

			if ($db -> query("DELETE FROM items WHERE id=$id")) {
				echo "<script>
					alert('Успешно удалено');
					location.href = 'admin.php';
				</script>";
				exit();
			} else {
				var_dump($db->errorInfo());
			}
		}
		if(isset($_GET["new_cat"])) {
			$name = $_GET["new_cat"];
			if ($db -> query("INSERT INTO categories (name) VALUES ('$name')")) {
				echo "<script>
					alert('Успешно добавлено');
					location.href = 'admin.php';
				</script>";
			} else {
				var_dump($db->errorInfo());
			}
		}
		if(isset($_GET["new_item_name"])) {
			$name = $_GET["new_item_name"];
			$photo = $_GET["photo"];
			$description = $_GET["description"];
			$price = $_GET["price"];
			$category = $_GET["category"];

			if ($db -> query("INSERT INTO items (name, photo, description, price, category) VALUES ('$name', '$photo', '$description', $price, $category)")) {
				echo "<script>
					alert('Успешно добавлено');
					location.href = 'admin.php';
				</script>";
			} else {
				var_dump($db->errorInfo());
			}
		}
		if(isset($_GET["item_name"])) {
			$name = $_GET["item_name"];
			$photo = $_GET["photo"];
			$description = $_GET["description"];
			$price = $_GET["price"];
			$category = $_GET["category"];
			$id = $_GET["id"];

			if ($db -> query("UPDATE items SET name='$name', photo='$photo', description='$description', price=$price, category=$category WHERE id=$id")) {
				echo "<script>
					alert('Успешно обновлено');
					location.href = 'admin.php';
				</script>";
			} else {
				var_dump($db->errorInfo());
			}
		}
		if(isset($_GET["сat_name"])) {
			$name = $_GET["сat_name"];
			$id = $_GET["id"];
			if ($db -> query("UPDATE categories SET name='$name' WHERE id=$id")) {
				echo "<script>
					alert('Успешно обновлено');
					location.href = 'admin.php';
				</script>";
			} else {
				var_dump($db->errorInfo());
			}
		}
	}
	$categories = $db->query("SELECT * FROM categories") -> fetchAll(2);
	$items = $db->query("SELECT * FROM items") -> fetchAll(2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Панель администратора</h1>
	<main>
		<section class="categories">
			<h2>Категории</h2>
			<div class="container">
				<form action="#" class="item">
					<label>Название</label>
					<input type="text" name="new_cat">
					<button>Добавить</button>
				</form>
				<?php foreach ($categories as $item): ?>
				<form action="#" class="item">
					<label>Название</label>
					<input type="text" name="сat_name" value="<?= $item['name']; ?>" required>
					<input type="hidden" name="id" value="<?= $item['id']; ?>">
					<button>Обновить</button>
					<button name="delete_cat">Удалить</button>
				</form>
			<?php endforeach; ?>
			</div>
		</section>
		<hr>
		<section class="categories">
			<h2>Товары</h2>
			<div class="container">
				<form action="#" class="item">					
					<label for="">
						Название
						<input type="text" required name="new_item_name">
					</label>
					<label for="">
						Ссылка на фото
						<input type="text" required name="photo">
					</label>
					<label for="">
						Описание
						<textarea type="text" required name="description"></textarea>
					</label>
					<label for="">
						Цена
						<input type="number" required min="0" name="price">
					</label>
					<label>
						Категория
						<select name="category" id="">
						<?php foreach ($categories as $cat): ?>
							<option value="<?= $cat['id']; ?>">
								<?= $cat['name']; ?>		
							</option>
						<?php endforeach; ?>
					</select>
					</label>
					<button>Добавить</button>
				</form>
				<?php foreach ($items as $item): ?>
				<form action="#" class="item">
					<img src="<?= $item['photo']; ?>" alt="photo" width="100" height="100">
					<label for="">
						Название
						<input type="text" name="item_name" value="<?= $item['name']; ?>">
					</label>
					<label for="">
						Ссылка на фото
						<input type="text" name="photo" value="<?= $item['photo']; ?>">
					</label>
					<label for="">
						Описание
						<textarea type="text" name="description"><?= $item['description']; ?></textarea>
					</label>
					<label for="">
						Цена
						<input type="number" min="0" name="price" value="<?= $item['price']; ?>">
					</label>
					<label>
						Категория
						<select name="category" id="">
						<?php foreach ($categories as $cat): ?>
							<option <?php if($item['category'] == $cat['id']) echo "selected"; ?> value="<?= $cat['id']; ?>">
								<?= $cat['name']; ?>		
							</option>
						<?php endforeach; ?>
					</select>
					</label>
					<input type="hidden" name="id" value="<?= $item['id']; ?>">
					<button>Обновить</button>
					<button name="delete">Удалить</button>
				</form>
			<?php endforeach; ?>
			</div>
		</section>
	</main>
</body>
</html>