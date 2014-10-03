<? // Settings
	
	$client = 'PropellerComms';
	$clientID = 000;
	$access_token = 'xxx';
	$app_secret = 'xxx';

	$count = 5;
	$char_limit = 126;

	try {

    	$json = file_get_contents('https://graph.facebook.com/'.$client.'/feed?access_token='.$access_token.'|'.$app_secret);
    	$feed = json_decode($json);

	} catch(Exception $e) {};


?>

<? if(isset($json)) :?>

	<? for($i = 0; $i < $count; $i++) : ?>

		<? 	$entry = $feed->data[$i];

			if (isset($entry->story) || $entry->from->id != $clientID) : $count++; continue; endif;

		?>

		
		<p>
			<?= substr($entry->message, 0, $char_limit); ?>
			<?= $char_limit > strlen($entry->message) ? '' : '...'; ?>

			<? if(isset($entry->picture)) : ?>

				<a href="<?= $entry->picture;?>" target="_blank">View image...</a>

			<? endif;?>
		</p>

	<? endfor; ?>

<? else :?>

	<p>Sorry, Facebook feed not available. Try again later.</p>

<? endif;?>