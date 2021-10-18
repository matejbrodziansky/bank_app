<?php

function pre_r($expression, $return = false)
{
	if ($return) {
		if (is_string($expression)) return '<pre>' . print_r(str_replace(array('<', '>'), array('&lt;', '&gt;'), $expression), true) . '</pre>';
		return '<pre>' . print_r($expression, true) . '</pre>';
		exit;
	} else {
		echo '<pre>';
		if (is_string($expression)) print_r(str_replace(array('<', '>'), array('&lt;', '&gt;'), $expression), false);
		else print_r($expression, false);
		exit;
		echo '</pre>';
	}
}

function UniqueRandomNumbersWithinRange($token_length = 10,  $letters = False)
{
	if ($alfa = $letters ? "abcdefghijklmnopqrstuvwxyz1234567890" : '1234567890');

	$token = "";
	for ($i = 1; $i < $token_length; $i++) {

		while (strlen($token) < $token_length) :
			@$token .= $alfa[rand(0, strlen($alfa))];
		endwhile;
	}

	$token = str_shuffle($token);

	return $token;
}


function ccMasking($number, $mask_front , $mask_back , $maskingCharacter = 'X')
{
	return substr($number, 0, 0) . str_repeat($maskingCharacter, strlen($number) - $mask_front) . substr($number, - $mask_back);
}

function whiteSpaces($number, $space){
	return	wordwrap($number, $space, " ", true);
}

function user_uniq_number()
{
	$ci = &get_instance();

	if (!$uid = uid()) return FALSE;

	$query = $ci->db->select('unique_number')
		->where('id', $uid)
		->get('users');

	return $query->row()->unique_number;
}
