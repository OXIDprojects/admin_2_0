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
    ),
    'files' => array(
		'adm2rest_api' => 'admin20/admin/adm2rest_api.php',
		'adm2oauth' => 'admin20/core/adm2oauth.php',
    ),
   'templates' => array(
		'adm2rest_api.tpl' => 'admin20/out/admin/tpl/adm2rest_api.tpl',
    ),
    'blocks' => array(
    ),
   'settings' => array(
    ),
);