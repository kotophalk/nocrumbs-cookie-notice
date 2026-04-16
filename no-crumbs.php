<?php
/**
 * Plugin Name: No Crumbs
 * Plugin URI: https://github.com/kotophalk/no-crumbs
 * Description: Минималистичный плагин из серии "установил и забыл" для уведомлений о cookie (152-ФЗ). Нуль влияния на скорость загрузки.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Tested up to: 6.8
 * Requires PHP: 7.4
 * Author: Kotophalk
 * Author URI: https://github.com/kotophalk
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: no-crumbs
 */

// Защита от прямого доступа к файлу
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Константы плагина
define( 'NO_CRUMBS_VERSION', '1.0.0' );
define( 'NO_CRUMBS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NO_CRUMBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Подключение главного класса плагина
require_once NO_CRUMBS_PLUGIN_DIR . 'includes/class-no-crumbs.php';

/**
 * Загрузка файлов локализации.
 */
function no_crumbs_load_textdomain() {
    load_plugin_textdomain( 'no-crumbs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'no_crumbs_load_textdomain' );

/**
 * Инициализация плагина.
 */
function run_no_crumbs() {
    $plugin = new No_Crumbs();
    $plugin->init();
}

// Запускаем при загрузке всех плагинов
add_action( 'plugins_loaded', 'run_no_crumbs' );
