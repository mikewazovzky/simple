<!DOCTYPE html>
<html>
<head>
	<title>Names</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<h1>Article:</h1>
	<br>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo $article->title; ?>
			[<?php echo $article->id; ?>]			
		</div>
		<div class="panel-body">
			Автор:
			<strong>
				<?php echo $article->author; ?>
			</strong>
			<br>
			Опубликовано:
			<?php echo $article->time; ?>
			<hr>
			<?php echo $article->body; ?>
		</div>			
	</div>
</div>	
</body>
</html>