<?php
/**
 * Chinese to Pinyin Tool
 * @author Jeffrey Wang
*/

?>
<html>
	<head>
		<title>Chinese to Pinyin Tool</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	</head>
	<body>
		<div class="container" style="margin-bottom: 10px; padding-bottom: 10px">
			<h1>Chinese to Pinyin Tool</h1>
			<?php
			if ( $_REQUEST['submit'] == 'yes' ) {
				$c = mb_convert_encoding ( $_REQUEST['chinese'], 'HTML-ENTITIES' );
				$c2p = json_decode ( mb_convert_encoding( file_get_contents ( 'chinese2pinyin_final.txt' ), 'HTML-ENTITIES', "UTF-16" ) , true );
				//print_r( $c2p );
				$pyo = '';
				for ( $i = 0; $i < strlen ( $c ); $i++ ) {
					$pyo += $c2p[substr ( $c, $i, 1 )] + " ";
				}
			?>
				<textarea cols="50" rows="15"><?php echo $c2p['a']; echo $pyo; ?></textarea><br />
				<a class="btn btn-primary" href="index.php">Back</a>
			<?php
			} else {
			?>
				<form method="post" action="index.php">
					<input type="hidden" name="submit" value="yes">
					<textarea name="chinese" cols="50" rows="15"></textarea><br />
					<button type="submit" class="btn btn-primary">Convert</button><button type="reset" class="btn btn-danger">Reset form</button><br />
				</form>
			<?php
			}
			?>
		</div>
		<div class="container" style="margin-bottom: 50px">
			<p>Chinese to Pinyin Tool made by Jeffrey Wang, &copy; 2016.</p>
			<p>Hosting generously provided by <a href="https://www.mywikis.com/">MyWikis</a>.</p>
		</div> <!-- .container -->
	</body>
</html>
