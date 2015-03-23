<?php


add_action('admin_menu', 'sbs_plugin_settings');

function sbs_plugin_settings() {

	add_submenu_page('edit.php?post_type=wp3dm_images', '3D Motion Slider Settings', 'Slider Settings', 'edit_posts', basename(__FILE__), 'sbs_settings_page');

}

	function sbs_settings_page() {

    $slide_effect = (get_option('fwds_effect') == 'slide') ? 'selected' : '';

    $fade_effect = (get_option('fwds_effect') == 'fade') ? 'selected' : '';

    $interval = (get_option('fwds_interval') != '') ? get_option('fwds_interval') : '2000';

    $autoplay  = (get_option('fwds_autoplay') == 'enabled') ? 'checked' : '' ;

    $playBtn  = (get_option('fwds_playBtn') == 'enabled') ? 'checked' : '' ;

    $html = '</pre>
<div class="wrap"><form action="options.php" method="post" name="options">
<h2>Select Your Settings</h2>
<h3>Please Use This ShortCode to Display Slider <pre>[wp3d-slider]</pre></h3>
' . wp_nonce_field('update-options') . '
<table class="form-table" width="100%" cellpadding="10">
<tbody>
<tr>
<td scope="row" align="left">
 <label>Slider Effect</label>
<select name="fwds_effect"><option value="slide">Slide</option><option value="fade">Fade</option></select></td>
</tr>
<tr>
<td scope="row" align="left">
 <label>Enable Auto Play</label><input type="checkbox" name="fwds_autoplay" value="enabled" /></td>
</tr>
<tr>
<td scope="row" align="left"><label>Enable Play Button</label><input type="checkbox" name="fwds_playBtn" value="enabled" /></td>
</tr>
<tr>
<td scope="row" align="left">
 <label>Transition Interval</label><input type="text" name="fwds_interval" value="' . $interval . '" /></td>
</tr>
</tbody>
</table>
 <input type="hidden" name="action" value="update" />

 <input type="hidden" name="page_options" value="fwds_autoplay,fwds_effect,fwds_interval,fwds_playBtn" />

 <input type="submit" name="Submit" value="Update" /></form></div>
<pre>
';

    echo $html;

}

?>
