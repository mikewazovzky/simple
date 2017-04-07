<?php
require __DIR__ . '/../vendor/autoload.php';

use News\Models\Article;
?>

<h2>Список статей</h2>
<ul>
	<?php foreach (Article::getEach() as $article) : ?>
		<li>
			<?php echo $article->title; ?> 
			[<strong><?php echo $article->author; ?></strong>]
		</li>
	<?php endforeach; ?>
<ul>