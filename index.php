<?php
if (isset($_POST['query'])) {
	$query = $_POST['query'];
	require dirname(__FILE__) . '/sqlFormatter.php';
	$o = new SqlFormatter();
	$formattedQuery = $o->format($query);
} else {
	$query = '';
	$formattedQuery = '';
}
?>
<form method="POST">
<label for="query">Query to format<label><br />
<textarea name="query" rows="10" cols="100"><?php echo $query; ?></textarea><br />
<input type="submit" value="Format!" />
<?php if($formattedQuery): ?>
<br />
<br />
<br />
<label for="formattedQuery">Formatted query<label><br />
<textarea name="formattedQuery" rows="10" cols="100"><?php echo $formattedQuery; ?></textarea>
<?php endif; ?>
</form>
