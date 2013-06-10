<?php

App::uses('AppModel', 'Model');

class Company extends AppModel {

	public $validate = array(

	);

	public function pagination($search = null, $sort = null, $asc = 'asc') {
		$pagination = array('limit' => 10);
		if ($search) $pagination['conditions'] = array('Company.name LIKE' => '%'.$search.'%');
		if ($sort) $pagination['order'] = array('Company.'.$sort => $asc);
		else $pagination['order'] = array("Company.name" => 'asc');
		return $pagination;
	}
}