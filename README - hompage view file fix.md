# Publish Prefix - homepage.php 

Publish Prefix modifies EEs menu in the top menu bar. This is done via the `cp_menu_array` hook. Unfortunately the homepage.php file in system > expressionengine > views > homepage.php view file does not expect a multi-dimensional array. And errors with:

	A PHP Error was encountered
	Severity: Notice
	Message: Array to string conversion
	Filename: views/homepage.php
	Line Number: 60
	Array" title="XX">XX
	A PHP Error was encountered
	
This file needs modifying on line 59, with the following code:

	<?php foreach($cp_menu_items['content']['publish'] as $channel_name => $uri):?>
		<?php if (is_array($uri)):?>
			<?php foreach($uri as $sub_channel_name => $sub_uri):?>
				<li><a href="<?=$sub_uri?>" title="<?=$channel_name.': '.$sub_channel_name?>"><?=$channel_name.': '.$sub_channel_name?></a></li>
			<?php endforeach; ?>
		<?php else:?>
			<li><a href="<?=$uri?>" title="<?=$channel_name?>"><?=$channel_name?></a></li>
		<?php endif; ?>	
	<?php endforeach; ?>
	
### *Open up your installed homepage.php and amend.