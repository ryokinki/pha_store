<?php
// +------------------------------------------------------------------
// | File: func.php
// +------------------------------------------------------------------
// | Author: jinhui - <ryokinki@163.com>
// +------------------------------------------------------------------
// | Create: 2018-10-09 23:50:32
// +------------------------------------------------------------------

function dd($params) {
	if (is_array($params)) {
		echo '<pre>';
		var_dump($params);
		echo '</pre>';
	} else if (is_object($params)) {
		echo '<pre>';
		var_dump($params);
		echo '</pre>';
	} else if (is_scalar($params)) {
		echo '--- '.$params.' ---</br>';
	}
	die;
}
