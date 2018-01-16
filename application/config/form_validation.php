<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
	'login' => array(
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required|alpha|min_length[3]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[3]|alpha_dash'
		)
	),
	'forgot' => array(
		array(
			'field' => 'ownerid',
			'label' => 'Team',
			'rules' => 'required|is_natural'
		)
	),
	'talk' => array(
		array(
			'field' => 'category',
			'label' => 'Category',
			'rules' => 'required|alpha|exact_length[1]'
		),
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		),
		array(
			'field' => 'text',
			'label' => 'Message',
			'rules' => 'required'
		)
	),
	'talk_update' => array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		),
		array(
			'field' => 'text',
			'label' => 'Message',
			'rules' => 'required'
		)
	),
	'contact' => array(
		array(
			'field' => 'subject',
			'label' => 'Subject',
			'rules' => 'required'
		),
		array(
			'field' => 'sender',
			'label' => 'Sender',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'recipients',
			'label' => 'Recipients',
			'rules' => 'required|valid_emails'
		),
		array(
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'required'
		)
	),
	'lineup' => array(
		array(
			'field' => 'AQB1',
			'label' => 'QB1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'AQB2',
			'label' => 'QB2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'AQB3',
			'label' => 'QB3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB1',
			'label' => 'RB1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB2',
			'label' => 'RB2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB3',
			'label' => 'RB3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB4',
			'label' => 'RB4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR1',
			'label' => 'WR1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR2',
			'label' => 'WR2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR3',
			'label' => 'WR4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR4',
			'label' => 'WR4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'DPK1',
			'label' => 'PK1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'DPK2',
			'label' => 'PK2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF1',
			'label' => 'DF1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF2',
			'label' => 'DF2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF3',
			'label' => 'DF3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF4',
			'label' => 'DF4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'FTX1',
			'label' => 'TX1',
			'rules' => 'required|numeric'
		)
	),
	'lineup_late' => array(
		array(
			'field' => 'AQB1',
			'label' => 'QB1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'AQB2',
			'label' => 'QB2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'AQB3',
			'label' => 'QB3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB1',
			'label' => 'RB1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB1',
			'label' => 'RB1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB2',
			'label' => 'RB2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'BRB3',
			'label' => 'RB3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR1',
			'label' => 'WR1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR2',
			'label' => 'WR2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR3',
			'label' => 'WR4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'CWR4',
			'label' => 'WR4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'DPK1',
			'label' => 'PK1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'DPK2',
			'label' => 'PK2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF1',
			'label' => 'DF1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF2',
			'label' => 'DF2',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF3',
			'label' => 'DF3',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'EDF4',
			'label' => 'DF4',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'FTX1',
			'label' => 'TX1',
			'rules' => 'required|numeric'
		),
		array(
			'field' => 'FTX2',
			'label' => 'TX2',
			'rules' => 'required|numeric'
		)
	),
	'trades' => array(
		array(
			'field' => 'year',
			'label' => 'Year',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'week',
			'label' => 'Week',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'date',
			'label' => 'Type',
			'rules' => 'required'
		),
		array(
			'field' => 'type',
			'label' => 'Type',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'update',
			'label' => 'Update Tables',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'team1_id',
			'label' => 'Team 1',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'team2_id',
			'label' => 'Team 2',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'player1_id',
			'label' => 'Player 1',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'player2_id',
			'label' => 'Player 2',
			'rules' => 'required|is_natural'
		)
	),
	'waiver' => array(
		array(
			'field' => 'year',
			'label' => 'Year',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'week',
			'label' => 'Week',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'date',
			'label' => 'Type',
			'rules' => 'required'
		),
		array(
			'field' => 'pick',
			'label' => 'Pick',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'team',
			'label' => 'Team',
			'rules' => 'required|is_natural'
		),
		array(
			'field' => 'add_player',
			'label' => 'Add Player ID',
			'rules' => 'required|is_natural'
		)
	)
);
?>