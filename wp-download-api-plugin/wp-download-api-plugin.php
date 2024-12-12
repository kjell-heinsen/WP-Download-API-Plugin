<?php
/*
Plugin Name: WordPress Download API Plugin
Plugin URI: https://heinsen-it.de/
Description: Plugin für die Kontrolle über die Downloads
Author: Heinsen-IT
Version: 0.0.0.0
Letztes Update: 2024-03-11 09:28:00
Author URI: https://heinsen-it.de/
MINIMAL WP: 6.0.0
MINIMAL PHP: 8.0.0
Tested WP: 6.4.1
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if(file_exists('config.php')) {
    require_once 'config.php';
}
define('DEBUG', FALSE);
define('BETA',FALSE);
define( 'WPDOWNLOADAPIP_VERSION', '0.0.0.0' );
define( 'WPDOWNLOADAPIP_MIN_PHP',   '8.0.0' );
define( 'WPDOWNLOADAPIP_MIN_WP',    '6.0.0' );
define( 'WPDOWNLOADAPIP_TESTED_WP',    '6.4.1' );
define( 'WPDOWNLOADAPIP_DIRPATH', plugin_dir_path( __FILE__ ) );
define( 'WPDOWNLOADAPIP_ASSETS',plugins_url('static/', __FILE__ ));
define( 'WPDOWNLOADAPIP_LIB', plugin_dir_path( __FILE__ ) . 'lib/' );
define( 'WPDOWNLOADAPIP_CLASSES', plugin_dir_path( __FILE__ ) . 'classes/' );
define( 'WPDOWNLOADAPIP_SITES', plugin_dir_path( __FILE__ ) . 'sites/' );
define( 'WPDOWNLOADAPIP_FUNCTIONS', plugin_dir_path( __FILE__ ) . 'functions/' );
define( 'WPDOWNLOADAPIP_TEMPLATES', plugin_dir_path( __FILE__ ) . 'templates/' );
$basename = 'hit-cdnhandler';
$project_id = licencemanager::GetProjectID();
$plugin_lizenz = licencemanager::Get();
if(file_exists(WPDOWNLOADAPIP_FUNCTIONS . 'functions.php')) {
    require_once WPDOWNLOADAPIP_FUNCTIONS . 'functions.php';
}

$server = random_int(1,4);

$plugin_updateurl = "https://wpu".$server.".heinsen-it.de/updates/".$basename."/";


if($project_id <> ''){
    $plugin_updateurl = $plugin_updateurl.$project_id."/";
}
if($plugin_lizenz <> ''){
    $plugin_updateurl = $plugin_updateurl.$plugin_lizenz."/";
}



require WPDOWNLOADAPIP_LIB.'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5p3\PucFactory;

$MyUpdateChecker = PucFactory::buildUpdateChecker(
    $plugin_updateurl,
    __FILE__, //Full path to the main plugin file.
    $basename //Plugin slug. Usually it's the same as the name of the directory.
);




