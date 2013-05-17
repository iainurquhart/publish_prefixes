//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
					<?php foreach($cp_menu_items['content']['publish'] as $channel_name => $uri):?>
						<?php if (is_array($uri)):?>
							<?php foreach($uri as $sub_channel_name => $sub_uri):?>
								<li><a href="<?=$sub_uri?>" title="<?=$channel_name.': '.$sub_channel_name?>"><?=$channel_name.': '.$sub_channel_name?></a></li>
							<?php endforeach; ?>
						<?php else:?>
							<li><a href="<?=$uri?>" title="<?=$channel_name?>"><?=$channel_name?></a></li>
						<?php endif; ?>	
					<?php endforeach; ?>
//
//
//
//
//
//

/* End of file homepage.php */
/* Location: ./themes/cp_themes/default/homepage.php */