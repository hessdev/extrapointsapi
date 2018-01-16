<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_Session $session
* @property View $view
*/
class Api_controller extends CI_Controller {

	function Api_controller() {
		parent::__construct();
		$this->load->model('League_model', 'league', TRUE);
		$this->load->model('Teams_model', 'teams', TRUE);
		$this->load->model('Lineup_model', 'lineup', TRUE);
		$this->load->model('Scores_model', 'scores', TRUE);
	}

	function info($year = 2017) {
		$data = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$year = max($this->config->item('data_years'));
		}
		$now = new DateTime($this->config->item('now'), $this->config->item('timezone'));
		$data['title'] = $this->config->item('site_name');
		$data['roster_week'] = $this->lineup->roster_week($year);
		$scores_week = ($year == $this->config->item('default_year')) ? $this->scores->week($this->config->item('default_year'), $data['roster_week']) : $this->scores->week($year, $data['roster_week']);
		$data['scores_week'] = $scores_week;
		$data['lineup_week'] = $this->lineup->week($year);
		$data['year'] = $year;
		$data['years'] = $this->config->item('data_years');
		$data['draft_year'] = $this->config->item('draft_pick_year');
		$data['draft_years'] = $this->config->item('draft_years');
		$data['career_years'] = $this->config->item('career_years');
		$schedule_year = ($year != $this->config->item('draft_pick_year')) ? $year : $this->config->item('draft_pick_year');
		if ($year == $this->config->item('default_year') && $this->config->item('default_year') !=  $this->config->item('draft_pick_year')) {
			$schedule_year = $this->config->item('draft_pick_year');
		}
		$data['schedule_year'] = $schedule_year;
		$data['now'] = $now->format(DATE_ATOM);
		$logged_in = $this->userauth->logged_in();
		$data['logged_in'] = $logged_in;
		if ($logged_in) {
			$user_slug = $this->session->userdata('slug');
			$data['user'] = array(
				'id' => $this->session->userdata('id'),
				'slug' => $user_slug,
				'username' => $this->session->userdata('username'),
				'division' => $this->session->userdata('division'),
				'firstname' => $this->session->userdata('firstname'),
				'lastname' => $this->session->userdata('lastname'),
				'url' => site_url('team/'.$user_slug.'/'.$year),
				'is_admin' => $this->session->userdata('username') == $this->config->item('admin_username')
			);
		} else {
			$data['user'] = null;
		}
		$this->render($data, 200);
	}

	function lineup($year = 2017, $week = 0, $owner_id = 0) {
		$logged_in = $this->userauth->logged_in();
		$now = new DateTime($this->config->item('now'), $this->config->item('timezone'));
		$data = array(
			'now' => $now->format(DATE_ATOM),
			'success' => true,
			'messages' => array()
		);
		$response_code = 200;
		$has_valid_params = true;
		$lineup = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$year = max($this->config->item('data_years'));
		}
		if (preg_match('/week(\d+)/', $week, $matches)) {
			$week = intval($matches[1]);
			if ($week > 17 || $week < 1) {
				$has_valid_params = false;
			}
		} else {
			$week = ($year == $this->config->item('default_year')) ? $this->scores->week($this->config->item('default_year')) : $this->scores->week($year);
		}
		if (empty($owner_id)) {
			$has_valid_params = false;
		}
		if ($has_valid_params) {
			//log_message('debug', 'lineup->get: has valid params');
			//log_message('debug', 'lineup->POST: '.print_r($_POST, true));
			$data['title'] = 'Week '.$week.' Lineup › '.$year;
			if (!empty($_POST)) {
				if ($logged_in) {
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('','^');
					$validation_rule = ($week >= $this->config->item('taxi_squad_start_week')) ? 'lineup_late': 'lineup';
					log_message('debug', 'lineup->validation_rule: '.$validation_rule);
					if ($this->form_validation->run($validation_rule) == FALSE) {
						$errors = explode('^', validation_errors());
						foreach($errors as $i => $error) {
							$errors[$i] = trim(preg_replace('/\s\s+/', ' ', $error));
						}
						$data['messages'] = array_filter($errors);
						log_message('debug', 'lineup->messages: '.print_r($data['messages'], true));
						$data['success'] = false;
					} else {
						$this->load->model('Players_model', 'players', TRUE);
						$num_roster_pos = $this->config->item('num_roster_pos');
						$pos_prefixes = $this->config->item('pos_prefixes');
						$num_starters = $this->config->item('num_starters');
						$positions = $this->config->item('positions');
						$email_data = array();
						foreach($positions as $p => $pos) {
							for ($i = 1; $i <= $num_roster_pos[$p]; $i++) {
								$key = $pos_prefixes[$p].$pos.$i;
								if ($key == 'FTX2' && $week < $this->config->item('taxi_squad_start_week')) continue;
								$lineup_data[$key] = ($this->input->post($key, TRUE) != '') ? $this->input->post($key, TRUE) : null;
								if ($i <= $num_starters[$p] && $num_starters[$p] > 0) {
									$player = $this->players->get($lineup_data[$key], $year);
									//log_message('debug', 'lineup->player: '.print_r($player, true));
									$label = ($num_starters[$p] > 1) ? $pos.$i : $pos;
									$email_data[$label] = (!empty($player)) ? $player['player_name'] : 'Unknown';
								}
							}
						}
						if ($this->lineup->update($year, $week, $owner_id, $lineup_data)) {
							$email_params = array();
							$team = $this->teams->get_by_id($owner_id, $year);
							$email_params['team'] = $team;
							$email_params['week'] = $week;
							$email_params['year'] = $year;
							$email_params['data'] = $email_data;
							$msg = $this->load->view('lineup_email', $email_params, TRUE);
							$msg_txt = $this->load->view('lineup_email_text', $email_params, TRUE);
							$this->load->library('email');
							$this->email->subject($team['teamname'].': Lineup Submission Week '.$week.' '.$year);
							$this->email->message($msg);
							$this->email->from($this->config->item('commissioner_email'), 'FF Commissioner');
							$recipients = array();
							$reply_to = '';
							if (!empty($team['email'])) {
								array_push($recipients, $team['email']);
								$reply_to = $team['email'];
							}
							if (!empty($team['email1'])) {
								array_push($recipients, $team['email1']);
								if (empty($reply_to)) $reply_to = $team['email1'];
							}
							if (!empty($team['email2'])) {
								array_push($recipients, $team['email2']);
								if (empty($reply_to)) $reply_to = $team['email2'];
							}
							$this->email->to($recipients);
							$this->email->cc($this->config->item('commissioner_email'), 'FF Commissioner');
							if (!empty($reply_to)) $this->email->reply_to($reply_to);
							$this->email->set_alt_message($msg_txt);
							if ($this->email->send()) {
								$data['messages'][] = 'Lineup submitted successfully';
							} else {
								$data['messages'][] = 'Update lineup failed: mail failed';
							}
						} else {
							$data['messages'][] = 'Update lineup failed';
						}
					}
				} else {
					$data['messages'][] = 'Login required to set lineup';
				}
			} else {
				log_message('debug', 'lineup->get: no POST data');
			}
			$data['roster'] = $this->lineup->get($owner_id, $year, $week);
		} else {
			$data['roster'] = array();
			$data['title'] = 'Lineup Unavailable';
			$response_code = 204;
		}
		$this->render($data, $response_code);
	}

	function login() {
		$this->output->enable_profiler(true);
		//log_message('debug', 'Api_controller::login');
		$this->load->library('form_validation');
		$data = array(
			'success' => false,
			'messages' => array(),
			'user' => null
		);
		// GET JSON data
		//$params = json_decode(file_get_contents('php://input'), true);
		//log_message('debug', 'Api_controller::login::_POST: '.print_r($_POST, true));
		//log_message('debug', 'Api_controller::login::username: '.$this->input->post('username'));
		if ($this->input->post('username')) {
			if ($this->form_validation->run('login') == FALSE) {
				if (form_error('username') != '') $data['messages'][] = array(
					'field' => 'username',
					'message' => strip_tags(form_error('username'))
				);
				if (form_error('password') != '') $data['messages'][] = array(
					'field' => 'password',
					'message' => strip_tags(form_error('password'))
				);
				//log_message('debug', 'Login page validation failed: '.validation_errors());
				//log_message('debug', 'Login page username validation failed: '.form_error('username'));
				//log_message('debug', 'Login page password validation failed: '.form_error('password'));
			} else {
				//log_message('debug', 'Login page validation succeeded');
				list($logged_in, $msg) = $this->userauth->login($this->input->post('username'), $this->input->post('password'));
				$field = 'form';
				if (preg_match("/username/i", $msg)) {
					$field = 'username';
				} elseif (preg_match("/password/i", $msg)) {
					$field = 'password';
				}
				$data['messages'][] = array(
					'field' => $field,
					'message' => $msg
				);
				//log_message('debug', 'Login results for '.$this->input->post('username').' : '.$logged_in);
				if ($logged_in) {
					$year = max($this->config->item('data_years'));
					$user_slug = $this->session->userdata('slug');
					$user_url = site_url('team/'.$user_slug.'/'.$year);
					$data['success'] = true;
					$data['user'] = array(
						'id' => $this->session->userdata('id'),
						'slug' => $user_slug,
						'username' => $this->session->userdata('username'),
						'division' => $this->session->userdata('division'),
						'firstname' => $this->session->userdata('firstname'),
						'lastname' => $this->session->userdata('lastname'),
						'url' => $user_url
					);
				}
			}
		} else {
			$data['messages'][] = array(
				'field' => 'form',
				'message' => 'No credentials submitted'
			);
		}
		$this->render($data, 200);
	}

	function logout() {
		$data = array(
			'success' => true,
			'message' => '',
			'user' => null
		);
		$this->userauth->logout();
		if (empty($this->session->userdata('id'))) {
			$data['success'] = true;
			$data['message'] = 'Logout successful';
		} else {
			$data['message'] = 'Logout failed';
		}
		$this->render($data, 200);
	}

	function forgot_password() {
		$this->load->library('form_validation');
		log_message('debug', 'Api_controller::forgot');
		$data = array(
			'success' => false,
			'messages' => array()
		);
		if ($this->input->post('ownerid')) {
			if ($this->form_validation->run('forgot') == FALSE) {
				if (form_error('ownerid') != '') $data['messages'][] = array(
					'type' => 'danger',
					'message' => strip_tags(form_error('ownerid'))
				);
			} else {
				if ($this->userauth->send_password($this->input->post('ownerid', true))) {
					$data['success'] = true;
					$data['messages'][] = array(
						'type' => 'success',
						'message' => 'Password sent successfully'
					);
				} else {
					$data['messages'][] = array(
						'type' => 'danger',
						'message' => 'Send Password Failed'
					);
				}
			}
		} else {
			$data['messages'][] = array(
				'type' => 'danger',
				'message' => 'No team selected'
			);
		}
		$this->render($data, 200);
	}

	function draft($year = 2017, $owner_slug = '') {
		$data = array();
		$response_code = 200;
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		$has_valid_params = in_array($year, $this->config->item('draft_years'));
		if ($has_valid_params) {
			$data['draft'] = $this->league->draft($year, $owner_slug);
			if (empty($owner_slug)) {
				$data['title'] = 'Draft › '.$year;
			} else {
				$team = $this->teams->get_by_slug($owner_slug);
				$data['title'] = (!empty($team)) ? $team['teamname'].' › Draft › '.$year : 'Draft › '.$year;
			}
		} else {
			$data['draft'] = array();
			$data['title'] = 'Draft Unavailable';
			$response_code = 204;
		}
		$this->render($data, $response_code);
	}

	function career($start_year = 1996, $end_year = 2016) {
		$this->load->model('Career_model', 'career', TRUE);
		$data = array();
		$response_code = 200;
		$start_year = filter_var($start_year, FILTER_SANITIZE_NUMBER_INT);
		$end_year = filter_var($end_year, FILTER_SANITIZE_NUMBER_INT);
		log_message('debug', 'career range start('.$start_year.') end('.$end_year.')');
		$has_valid_params = in_array($start_year, $this->config->item('career_years'));
		if ($has_valid_params) {
			$has_valid_params = in_array($end_year, $this->config->item('career_years'));
		} else {
			log_message('debug', 'career invalid start year');
		}
		if ($has_valid_params) {
			$has_valid_params = $start_year <= $end_year;
		} else {
			log_message('debug', 'career invalid end year');
		}
		if ($has_valid_params) {
			list($career_stats, $min_year, $max_year) = $this->career->data($start_year, $end_year);
			$data['career'] = $career_stats;
			$data['min_year'] = $min_year;
			$data['max_year'] = $max_year;
			$data['title'] = 'Career Stats › '.$start_year.' - '.$end_year;
		} else {
			log_message('debug', 'career invalid range');
			$data['career'] = array();
			$data['title'] = 'Career Stats Unavailable';
			$response_code = 204;
		}
		$this->render($data, $response_code);
	}

	function nfl_schedule($year = 2017) {
		$data = array();
		$response_code = 200;
		$schedule = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$year = $this->league->get_schedule_max_year();
		}
		$schedule = $this->league->nfl_schedule($year);
		if (!empty($schedule)) {
			$data['title'] = 'NFL Schedule › '.$year;
			$data['schedule'] = $schedule;
		} else {
			$data['title'] = 'NFL Schedule Unavailable';
			$data['schedule'] = array();
			$response_code = 404;
		}
		$this->render($data, $response_code);
	}

	function scores($year = 2017) {
		$data = array();
		$response_code = 200;
		$has_valid_params = true;
		$scores_results = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$has_valid_params = false;
		}
		if (preg_match('/week(\d+)/', $this->uri->segment(3), $matches)) {
			$week = intval($matches[1]);
			if ($week > 17 || $week < 1) {
				$has_valid_params = false;
			}
		} elseif ($has_valid_params) {
			$week = ($year == $this->config->item('default_year')) ? $this->scores->week($this->config->item('default_year')) : $this->scores->week($year);
		}
		$team_id = 0;
		if ($has_valid_params) {
			$owner = array();
			if ($this->uri->segment(4) != '') {
				$team_id = filter_var($this->uri->segment(4), FILTER_SANITIZE_NUMBER_INT);
				$owner = $this->teams->get_by_id($team_id, $year);
				if (empty($owner)) {
					$team_id = 0;
					$has_valid_params = false;
				}
			}
		}
		if ($has_valid_params) {
			$scores_results = $this->scores->data($year, $week, $team_id);
		}
		if (!empty($scores_results)) {
			$data['title'] = 'Week '.$week.' Scores › '.$year;
			$data['scores'] = $scores_results;
		} else {
			$data['title'] = 'Scores Unavailable';
			$data['scores'] = array();
			$response_code = 404;
		}
		$this->render($data, $response_code);
	}

	function talk($page_num = 1, $category = '') {
		$this->load->model('Talk_model', 'talk', TRUE);
		$response_code = 200;
		$category_code = '';
		$cat_names = $this->config->item('talk_cat_names');
		$cats = $this->config->item('talk_cats');
		if (!in_array($category, $cat_names)) {
			$category = 'all';
			$category_code = '';
		} else {
			$category_code = substr($category, 0, 1);
		}
		$num_items = $this->talk->count($category_code);
		log_message('debug', 'talk('.$category_code.'): '.$num_items);
		$page_num = filter_var($page_num, FILTER_SANITIZE_NUMBER_INT);
		$num_pages = ceil($num_items / $this->config->item('talk_items_per_page'));
		if (!is_numeric($page_num)) {
			$page_num = 1;
		} elseif ($page_num < 1) {
			$page_num = 1;
		} elseif ($page_num > $num_pages) {
			$page_num = $num_pages;
		}
		$start_rec = $page_num * $this->config->item('talk_items_per_page') - $this->config->item('talk_items_per_page');
		switch($category) {
			case 'commish':
				$data['title'] = 'Commissioner\'s Notes';
				break;
			case 'smack':
				$data['title'] = 'League Posts';
				break;
			default:
				$data['title'] = 'All Posts';
				break;
		}
		$data['page'] = $page_num;
		$data['pages'] = $num_pages;
		$data['count'] = $num_items;
		$data['items'] = $this->talk->get($category_code, $start_rec);
		if (empty($data['items'])) {
			$response_code = 404;
		} else {
			foreach ($data['items'] as $i => $item) {
				$data['items'][$i]['text'] = strip_tags($item['text'], '<div><span><a><b><strong><i><em><ul><ol><li>');
			}
		}
		$this->render($data, $response_code);
	}

	function teams($year = 2017, $week = 0) {
		$data = array();
		$response_code = 200;
		$has_valid_params = true;
		$team_results = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$year = max($this->config->item('data_years'));
		}
		if (preg_match('/week(\d+)/', $week, $matches)) {
			$week = intval($matches[1]);
			if ($week > 17 || $week < 1) {
				$has_valid_params = false;
			}
		} else {
			$week = ($year == $this->config->item('default_year')) ? $this->scores->week($this->config->item('default_year')) : $this->scores->week($year);
		}
		if ($has_valid_params) {
			$team_results = $this->teams->data($year, $week);
		}
		if (!empty($team_results)) {
			$data['title'] = 'Week '.$week.' Teams › '.$year;
			$data['teams'] = $team_results;
		} else {
			$data['title'] = 'Teams Unavailable';
			$data['teams'] = array();
			$response_code = 404;
		}
		$this->render($data, $response_code);
	}

	function player($player_id = 0, $year = 2017) {
		$data = array();
		$response_code = 200;
		if (!empty($player_id) && is_numeric($player_id)) {
			$this->load->model('Players_model', 'players', TRUE);
			$data = $this->players->get($player_id, $year);
			if (!empty($data)) {
				$data['results'] = $this->players->results($player_id, $year);
			} else {
				$response_code = 404;
			}
		} else {
			$response_code = 404;
		}
		$this->render($data, $response_code = 200);
	}

	function players($year = 2017, $position = 'all') {
		$this->load->model('Players_model', 'players', TRUE);
		$data = array();
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		if (!in_array($year, $this->config->item('data_years'))) {
			$year = max($this->config->item('data_years'));
		}
		if (!in_array($position, array('all','qb','rb','wr','pk','df'))) {
			$position = 'all';
		}
		switch($position) {
			case 'qb':
				$data['title'] = 'Top Quarterbacks › '.$year;
				break;
			case 'rb':
				$data['title'] = 'Top Runningbacks › '.$year;
				break;
			case 'wr':
				$data['title'] = 'Top Receivers › '.$year;
				break;
			case 'pk':
				$data['title'] = 'Top Kickers › '.$year;
				break;
			case 'df':
				$data['title'] = 'Top Defensive Players › '.$year;
				break;
			default:
				$data['title'] = 'Top Players › '.$year;
				break;
		}
		$logged_in = $this->userauth->logged_in();
		$scores_week = $this->scores->week($year);
		$limit = ($logged_in && $this->session->userdata('username') == $this->config->item('admin_username')) ? 100 : 50;
		$data['players'] = $this->players->leaders($year, $scores_week, $position, $limit);
		$this->render($data);
	}

	function transactions($year = 2017, $owner_slug = '') {
		$data = array();
		$response_code = 200;
		$year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
		$has_valid_params = in_array($year, $this->config->item('data_years'));
		if ($has_valid_params) {
			if (empty($owner_slug)) {
				$data['transactions'] = $this->league->transactions($year, '');
				$data['title'] = 'Transactions '.$year;
			} else {
				$team = $this->teams->get_by_slug($owner_slug);
				$data['transactions'] = $this->league->transactions($year, $team['id']);
				$data['title'] = (!empty($team)) ? $team['teamname'].' › Transactions › '.$year : 'Transactions › '.$year;
			}
		} else {
			$year = $this->config->item('default_year');
			$data['transactions'] = array();
			$data['title'] = 'Transactions Unavailable';
			$response_code = 204;
		}
		$this->render($data, $response_code);
	}

	function page_not_found() {
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			if ($_SERVER['HTTP_ORIGIN'] == 'http://extpts.hess.com') {
				$http_origin = $_SERVER['HTTP_ORIGIN'];
			} else {
				$http_origin = 'https://www.extrapoints.net';
			}
		} else {
			$http_origin = $this->config->item('base_url');
		}
		$this->output
			->enable_profiler(false)
			->set_status_header('404')
			->set_header("Access-Control-Allow-Origin: $http_origin");
	}

	function render($data, $response_code = 200) {
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			if ($_SERVER['HTTP_ORIGIN'] == 'http://extpts.hess.com') {
				$http_origin = $_SERVER['HTTP_ORIGIN'];
			} else {
				$http_origin = 'https://www.extrapoints.net';
			}
		} else {
			$http_origin = $this->config->item('base_url');
		}
		$this->output
			->enable_profiler(false)
			->set_status_header($response_code)
			->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', strtotime('-5 minutes')).' GMT')
			->set_header('Expires: '.gmdate('D, d M Y H:i:s', strtotime('-1 day')).' GMT')
			->set_header('Cache-Control: no-store, no-cache, must-revalidate')
			->set_header('Cache-Control: post-check=0, pre-check=0')
			->set_header('Pragma: no-cache')
			->set_header("Access-Control-Allow-Origin: $http_origin")
			->set_content_type('application/json')
			->set_output(json_encode($data, JSON_NUMERIC_CHECK));
	}

}
?>