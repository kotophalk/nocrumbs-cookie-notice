<?php
/**
 * Plugin Name: NoCrumbs Cookie Notice
 * Plugin URI: https://delosvod.ru/
 * Description: Минималистичный плагин из серии "установил и забыл" для уведомлений о cookie (152-ФЗ). Нуль влияния на скорость загрузки.
 * Version: 1.2.0
 * Requires at least: 5.0
 * Tested up to: 6.9
 * Requires PHP: 7.4
 * Author: Лаборатория Делосвод
 * Author URI: https://stodum.ru/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: nocrumbs-cookie-notice
 */

// Защита от прямого доступа к файлу
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Константы плагина
define( 'NO_CRUMBS_VERSION', '1.2.0' );
define( 'NO_CRUMBS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NO_CRUMBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Подключение главного класса плагина
require_once NO_CRUMBS_PLUGIN_DIR . 'includes/class-no-crumbs.php';

/**
 * Инициализация плагина.
 */
function no_crumbs_run() {
    $plugin = new No_Crumbs();
    $plugin->init();
}

// Запускаем при загрузке всех плагинов
add_action( 'plugins_loaded', 'no_crumbs_run' );

// Брендинговые ссылки на странице плагинов
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'no_crumbs_add_action_links' );

/**
 * Добавляет ссылки на экосистему в строку действий плагина.
 *
 * @param array $links Существующие ссылки действий.
 * @return array Дополненный массив ссылок.
 */
function no_crumbs_add_action_links( $links ) {
    $custom_links = array(
        '<a href="https://stodum.ru/" target="_blank" style="color: #2271b1; font-weight: 500;">' . esc_html__( 'Техблог СТОДУМ', 'nocrumbs-cookie-notice' ) . '</a>',
        '<a href="https://delosvod.ru/" target="_blank">' . esc_html__( 'Больше инструментов', 'nocrumbs-cookie-notice' ) . '</a>',
    );
    return array_merge( $links, $custom_links );
}
