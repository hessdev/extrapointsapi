<?php

/**
*	View Library - simplifies management and loading of views in CodeIgniter applications
*
*	@author			Timothy Wood [codearachnid]
*	@last_modified	August 30, 2007
*
*/

class View {
	var $CI;
	var $vars = array();
	var $parts = array();
	var $modules = array();
	var $config = array();

	function View() {
		$this->CI =& get_instance();
		$this->config['css_dir'] = ($this->CI->config->item('css_dir') != '') ? $this->CI->config->item('css_dir') : '/';
		$this->config['js_dir'] = ($this->CI->config->item('javascript_dir') != '') ? $this->CI->config->item('javascript_dir') : '/';
		$this->config['lib_dir'] = ($this->CI->config->item('lib_dir') != '') ? $this->CI->config->item('lib_dir') : '/';
		$this->config['app_root'] = ($this->CI->config->item('app_dir') != '') ? $this->CI->config->item('app_dir') : '/';
	}

	function add_css($css_uri = '', $media_type = 'all', $browser = '', $charset = 'utf8', $var = 'css_list') {
		if ($css_uri == '') return false;
		if (!isset($this->vars[$var])) {
			$this->vars[$var] = array();
		}
		if (is_string($css_uri)) {
			if (stripos($css_uri, ',')) {
				$css_list = explode(",", $css_uri);
			} else {
				$css_list = array($css_uri);
			}
		}

		if (count($css_list) > 0) {
			$css_pattern = '/^' . preg_replace("/\//", "\/", $this->config['css_dir']) . '/';
			$lib_pattern = '/^' . preg_replace("/\//", "\/", $this->config['lib_dir']) . '/';
			foreach ($css_list as $css_file) {
				$pos = strpos($css_file, $this->config['app_root']);
				if (!empty($css_file)) {
					//echo 'CSS File: '.$css_file.' substr('.substr($css_file, 0, 3).')<br/>';
					if (substr($css_file, 0, 4) == 'http') {
						$css_file = $css_file;
					} elseif ($pos !== false) {
						$css_file = (substr($css_file, 0, 1) == '/' ) ? $css_file : '/'.$css_file;
					} elseif (!preg_match($css_pattern, $css_file) && !preg_match($lib_pattern, $css_file)) {
						$css_file = (substr($css_file, 0, 1) == '/' ) ? $this->config['css_dir'].$css_file : $this->config['css_dir'].'/'.$css_file;
					}
					//echo 'Add css: '.$css_file.'<br/>';
					array_push($this->vars[$var], array('css_uri' => $css_file, 'media_type' => $media_type, 'charset' => $charset, 'browser' => $browser));
				}
			}
		}
	}

	function add_script($script_uri = '', $type = 'text/javascript', $language = 'javascript', $var = 'script_list') {
		if ($script_uri == '') return false;
		if (!isset($this->vars[$var])) {
			$this->vars[$var] = array();
		}
		if (is_string($script_uri)) {
			if (stripos($script_uri, ',')) {
				$script_list = explode(",", $script_uri);
			} else {
				$script_list = array($script_uri);
			}
		}
		if (count($script_list) > 0) {
			$script_pattern = '/^' . preg_replace("/\//", "\/", $this->config['js_dir']) . '/';
			$lib_pattern = '/^' . preg_replace("/\//", "\/", $this->config['lib_dir']) . '/';
			foreach ($script_list as $script_file) {
				$pos = strpos($script_file, $this->config['app_root']);
				if (!empty($script_file)) {
					if (substr($script_file, 0, 4) == 'http') {
						$script_file = $script_file;
					} elseif ($pos !== false) {
						$script_file = (substr($script_file, 0, 1) == '/' ) ? $script_file : '/'.$script_file;
					} elseif (!preg_match($script_pattern, $script_file) && !preg_match($lib_pattern, $script_file) && substr($script_file, 0, 4) != 'http') {
						$script_file = (substr($script_file, 0, 1) == '/') ? $this->config['js_dir'].$script_file : $this->config['js_dir'].'/'.$script_file;
					}
					//echo 'Add script: '.$script_file.'<br/>';
					array_push($this->vars[$var], array('script_uri' => $script_file, 'type' => $type, 'language' => $language));
				}
			}
		}
	}

	function set($data, $value = NULL, $no_replace = FALSE) {		// no_replace: don't replace existing value
		if (is_array($data)) {
			foreach ($data as $k => $v) {
				$this->set($k, $v, $no_replace);
			}
		} elseif (!$no_replace || !isset($this->vars[$data])) {
			$this->vars[$data] = $value;
		}
	}

	function append($data, $value = NULL) {
		if (is_array($data)) {
			foreach ($data as $k => $v) {
				$this->append($k, $v);
			}
		} elseif (is_string($value)) {
			if (isset($this->vars[$data])) {
				$this->vars[$data] .= $value;
			} else {
				$this->vars[$data] = $value;
			}
		}
	}

	function get($name) {
		return (isset($this->vars[$name]) ? $this->vars[$name] : NULL);
	}

	function module($name, $view, $data = '') {
		$this->modules[$name] = $this->CI->load->view($view, $data, TRUE);
		/*
		log_message('debug', 'Added module '.$name);
		echo '<pre>'."\n";
		print_r($this->modules[$name]);
		echo '</pre>'."\n";
		*/
	}

	function part($name, $view) {
		$this->parts[$name] = $view;
	}

	function load($tpl, $data = array(), $return = FALSE) {
		$this->set($data);
		foreach ($this->parts as $name => $view) {
			$this->vars[$name] = $this->CI->load->view($view, $this->vars, TRUE);
		}
		return $this->CI->load->view($tpl, $this->vars, $return);
	}

}

?>