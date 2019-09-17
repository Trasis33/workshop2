<?php

class DateTimeView {


	public function show() {

		$timeString = 'The time is ' . date("l") . ', the ' . date("jS") . ' of ' . date("F Y");

		return '<p>' . $timeString . '</p>';
	}
}