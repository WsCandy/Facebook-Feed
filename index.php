<? // Settings
	
	$client = 'PropellerComms';
	$access_token = 'xxx';
	$app_secret = 'xxx';

	$count = 5;
	$char_limit = 200;

    $json = file_get_contents('https://graph.facebook.com/'.$client.'/feed?access_token='.$access_token.'|'.$app_secret);
    $feed = json_decode($json);

?>

<div class="feed-container">
	
	<? for($i = 0; $i < $count; $i++) :?>

		<div class="entry">
			
			<? 	$entry = $feed->data[$i];
				if (!isset($entry->message)) : $count++; continue; endif;
			?>

			<? if(isset($entry->picture)) :?>
				<p>
					<img src="<?= $entry->picture;?>" alt="<?= $entry->from->name;?>" />
				</p>
			<? endif;?>
			
			<p><?= substr($entry->message, 0, $char_limit); ?><?= $char_limit > strlen($entry->message) ? '' : '...';?></p>

			<? if(isset($entry->link)) :?>
				<p>
					<a href="<?= $entry->link;?>" target="_blank">Read more...</a>
				</p>
			<? endif;?>
			
			<p>Posted on: <?= date('d/m/Y', strtotime($entry->created_time));?> at <?= date('G:i', strtotime($entry->created_time));?></p>

		</div>

	<? endfor;?>
	
</div>