<?php

/**
 * All routes
 */
return [

	'' => [
		'controller' => 'home',
		'action' => 'index',
	],

	'user/login' => [
		'controller' => 'user',
		'action' => 'login',
	],

	'user/logout' => [
		'controller' => 'user',
		'action' => 'logout',
	],

	'task/update' => [
		'controller' => 'task',
		'action' => 'update',
	],

	'task' => [
		'controller' => 'task',
		'action' => 'index',
	],

	'task/delete' => [
		'controller' => 'task',
		'action' => 'delete',
	],

	'task/all' => [
		'controller' => 'task',
		'action' => 'all',
	],

	'task/show' => [
		'controller' => 'task',
		'action' => 'show',
	],

	'task/create' => [
		'controller' => 'task',
		'action' => 'create',
	],
	
];