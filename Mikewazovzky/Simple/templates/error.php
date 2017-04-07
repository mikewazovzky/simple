<!-- TEMPLATE: display error data -->
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>ERROR</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style type="text/css">
		body { color: #000000; background-color: #FFFFFF; }
		p, address {margin-left: 3em;}
		#msg {color: red;}
		#trace {font-size: smaller;}		
</style>
	
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1>ERROR!</h1>
			<h2>ERROR_CLASS: <span id="msg"><?php echo $class;?><span></h2>
			<p>ERROR_MESSAGE: <span id="msg"><?php echo $message;?></span></p>
			<p>ERROR_FILE: <?php echo $file;?></p>
			<p>ERROR_LINE: <?php echo $line;?></p>
			<h2>ERROR_CODE: <?php echo $code;?></h2>
			<p>ERROR_TRACE: <span id="trace"><?php echo $trace;?></span></p>
			<hr>
			<p>project: test.php by Mike Wazovzky (mike.wazovzky@gmail.com)</p>
		</div>	
	</div>
</body>
</html>