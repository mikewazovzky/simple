<!DOCTYPE html>
<html>
<head>
	<title>Names</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<!-- Select mode links -->
	<a href="?controller=Client">Client</a>
	<a href="?controller=Admin">Admin</a>
	<br>
	<br>
	<!-- Create new Article form available only to admin -->
	<?php if($admin) : ?>
		<hr>
		<h1>Create new Article</h1>
		<?php include __DIR__ . '/form.php'; ?>
	<?php endif; ?>
	
	<br>

	<h1>List of Articles</h1>

	<?php foreach ($articles as $article) : ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="?controller=Client&action=Single&id=<?php echo $article->id; ?>">
					<?php echo $article->title; ?>					
				</a>	
				published 
				by <strong><?php echo $article->author; ?></strong>
				at <?php echo $article->time; ?>
			</div>
			<div class="panel-body">
				<p><?php echo htmlspecialchars_decode($article->body); ?></p>
			</div>	
			
			<!-- Edit and Delete buttons available only to admin -->
			<?php if($admin) : ?>
				<div class="panel-footer">
					<a href="?controller=Admin&action=Edit&id=<?php echo $article->id; ?>">Edit</a>
					<a href="?controller=Admin&action=Delete&id=<?php echo $article->id; ?>">Delete</a>
				</div>	
			<?php endif; ?>

		</div>
	<?php endforeach; ?>

</div>
</body>
</html>