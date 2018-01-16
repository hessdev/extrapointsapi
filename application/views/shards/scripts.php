<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!empty($script_list) && is_array($script_list)) {
	foreach($script_list as $script) {
		if (substr($script['script_uri'], 0, 4) != 'http') {
			$script_path = ($this->config->item('site_root') == '') ? substr($script['script_uri'], 1) : $this->config->item('site_root').'/'.$script['script_uri'];
			$mod_time = date('Ymd-His', filemtime($script_path));
			$script_uri = $script['script_uri'].'?mod='.$mod_time;
		} else {
			$script_uri = $script['script_uri'];
		}
		echo '<script type="'.$script['type'].'" src="'.$script_uri.'"></script>'."\n";
	}
}
?>
