<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!empty($css_list) && is_array($css_list)) {
	$stylesheets = array();
	foreach($css_list as $stylesheet) {
		if (substr($stylesheet['css_uri'], 0, 4) != 'http') {
			$stylesheet_path = ($this->config->item('site_root') == '') ? substr($stylesheet['css_uri'], 1) : $this->config->item('site_root').'/'.$stylesheet['css_uri'];
			$mod_time = date('Ymd-His', filemtime($stylesheet_path));
			$css_uri = $stylesheet['css_uri'].'?mod='.$mod_time;
		} else {
			$css_uri = $stylesheet['css_uri'];
		}
		$css = '';
		if (in_array($stylesheet['browser'], array('IE 6', 'IE 7', 'IE 8'))) $css .= '<!--[if '.$stylesheet['browser'].']>'."\n";
		$css .= '<link rel="stylesheet" href="'.$css_uri.'" type="text/css" media="'.$stylesheet['media_type'].'" />';
		if (in_array($stylesheet['browser'], array('IE 6', 'IE 7', 'IE 8'))) $css .= '<![endif]-->'."\n";
		if (!in_array($stylesheet['css_uri'], $stylesheets)) {
			echo $css."\n";
			array_push($stylesheets, $stylesheet['css_uri']);
		}
	}
}
?>
