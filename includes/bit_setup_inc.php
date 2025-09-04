<?php
global $gBitSystem, $gLibertySystem;

$pRegisterHash = [
	'package_name' => 'phpgedview',
	'package_path' => dirname( dirname( __FILE__ ) ).'/',
];

// fix to quieten down VS Code which can't see the dynamic creation of these ...
define( 'PHPGEDVIEW_PKG_NAME', $pRegisterHash['package_name'] );
define( 'PHPGEDVIEW_PKG_URL', BIT_ROOT_URL . basename( $pRegisterHash['package_path'] ) . '/' );
define( 'PHPGEDVIEW_PKG_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/' );
define( 'PHPGEDVIEW_PKG_INDEX_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/index/'); 
define( 'PHPGEDVIEW_PKG_INCLUDE_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/includes/'); 
define( 'PHPGEDVIEW_PKG_CLASS_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/includes/classes/');
define( 'PHPGEDVIEW_PKG_ADMIN_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/admin/'); 

$gBitSystem->registerPackage( $pRegisterHash );

if( $gBitSystem->isPackageActive( 'phpgedview' ) ) {
	$menuHash = [
		'package_name'  => PHPGEDVIEW_PKG_NAME,
		'index_url'     => PHPGEDVIEW_PKG_URL.'index.php',
		'menu_template' => 'bitpackage:search/menu_search.tpl',
	];
	$gBitSystem->registerAppMenu( $menuHash );
}