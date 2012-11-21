<?php
/**
 * Metadata version
 */
$sMetadataVersion = '1.0';

/**
 * Module information
 */
$aModule = array(
		'id'           => 'admin20',
		'title'        => 'OXID Admin 2.0 oAuth',
		'description'  => '',
		'thumbnail'    => '',
		'version'      => '0.1.0',
		'author'       => 'Tobias Merkl',
		'url'          => 'https://github.com/OXIDprojects/admin_2_0',
		'email'        => 'tobias@merkl.eu',
		'extend'       => array(
				'oxadmindetails'=>'admin2/admin2rest',
		),
		'files' => array(
				'adm2rest_api' => 'admin2/admin/adm2rest_api.php',
				'adm2oauth' => 'admin2/core/adm2oauth.php',
		),
		'templates' => array(
				'admin2rest.tpl' => 'admin2/admin2rest.tpl',
		),
		'blocks' => array(
		),
		'settings' => array(
		),
);