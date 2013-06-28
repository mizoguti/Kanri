<?php

function age_from_dob($dob) {
    list($y,$m,$d) = explode('-', $dob);
    if (($m = (date('m') - $m)) < 0) {
        $y++;
    } elseif ($m == 0 && date('d') - $d < 0) {
        $y++;
    }
    return date('Y') - $y;
}

function avoid_blank($value) {
	if (isset($value) && $value != null && $value != '') return $value;
	else return '-';
}

function sortByStartDate($a, $b) {
	return strcmp($b['start_date'], $a['start_date']);
}

function formatCurrency($value = 0.0) {
	$value = bcadd(doubleval($value), 0, 2);
	return "R$ ".$value;
}

function formatDate($date) {
	$components = getdate(strtotime($date));
	if ($components['minutes'] < 10) $components['minutes'] = '0'.$components['minutes'];
	return $components['mday'].' de '.monthNumberToMonthString($components['mon']).' de '.$components['year'].' às '.($components['hours']).':'.$components['minutes'];
}

function formatDay($date) {
	$components = getdate(strtotime($date));
	return $components['mday'].' de '.monthNumberToMonthString($components['mon']).' de '.$components['year'];
}

function formatHour($date) {
	$components = getdate(strtotime($date));
	if ($components['minutes'] < 10) $components['minutes'] = '0'.$components['minutes'];
	return $components['hours'].':'.$components['minutes'];
}

function monthNumberToMonthString($monthNumber) {
	switch ($monthNumber) {
		case 1:
			return 'Janeiro';
			break;
		case 2:
			return 'Fevereiro';
			break;
		case 3:
			return 'Março';
			break;
		case 4:
			return 'Abril';
			break;
		case 5:
			return 'Maio';
			break;
		case 6:
			return 'Junho';
			break;
		case 7:
			return 'Julho';
			break;
		case 8:
			return 'Agosto';
			break;
		case 9:
			return 'Setembro';
			break;
		case 10:
			return 'Outubro';
			break;
		case 11:
			return 'Novembro';
			break;
		case 12:
			return 'Dezembro';
			break;
		default:
			return '';
			break;
	}
}