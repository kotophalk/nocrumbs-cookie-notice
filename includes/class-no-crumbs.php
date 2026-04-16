<?php

// Защита от прямого доступа
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Главный сервисный класс плагина No_Crumbs.
 */
class No_Crumbs {

    /**
     * Инициализация хуков WordPress.
     */
    public function init() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'wp_footer', array( $this, 'render_notice' ) );
    }

    /**
     * Подключение фронтенд ассетов (стилей и скриптов).
     */
    public function enqueue_assets() {
        // Строгая проверка, блокирующая выполнение в админпанели
        if ( is_admin() ) {
            return;
        }

        // Подключаем стили
        wp_enqueue_style(
            'no-crumbs-style',
            NO_CRUMBS_PLUGIN_URL . 'assets/css/no-crumbs.css',
            array(),
            NO_CRUMBS_VERSION,
            'all'
        );

        // Подключаем скрипты в футер (true)
        wp_enqueue_script(
            'no-crumbs-script',
            NO_CRUMBS_PLUGIN_URL . 'assets/js/no-crumbs.js',
            array(),
            NO_CRUMBS_VERSION,
            true 
        );
    }

    /**
     * Рендеринг HTML-разметки в футере страницы.
     */
    public function render_notice() {
        // Железобетонное отсечение панели администратора
        if ( is_admin() ) {
            return;
        }

        // Получаем ссылку на страницу "Политика конфиденциальности"
        $privacy_page_id = get_option( 'wp_page_for_privacy_policy' );
        $privacy_link    = '';

        if ( ! empty( $privacy_page_id ) ) {
            $privacy_url = get_permalink( $privacy_page_id );
            if ( $privacy_url ) {
                $privacy_link = sprintf(
                    ' <a href="%s" class="nc-privacy-link">%s</a>',
                    esc_url( $privacy_url ),
                    esc_html__( 'Политика конфиденциальности', 'no-crumbs' )
                );
            }
        }

        // Создаем готовые строки
        $notice_text = esc_html__( 'Мы используем файлы с данными (cookie) для работы сайта.', 'no-crumbs' ) . $privacy_link;
        $button_text = esc_html__( 'ОК', 'no-crumbs' );

        // Вывод HTML-формы баннера со скрытым состоянием "nc-hidden"
        ?>
<!-- No Crumbs Plugin -->
<div id="nc-cookie-banner" class="nc-hidden nc-cookie-card" aria-hidden="true" role="dialog" aria-labelledby="nc-cookie-text">
    <div class="nc-cookie-banner-content">
        <p id="nc-cookie-text"><?php echo wp_kses_post( $notice_text ); ?></p>
    </div>
    <div class="nc-cookie-banner-action">
        <button id="nc-cookie-accept" aria-label="<?php esc_attr_e( 'Принять и закрыть', 'no-crumbs' ); ?>">
            <?php echo esc_html( $button_text ); ?>
        </button>
    </div>
</div>
<!-- /No Crumbs Plugin -->
        <?php
    }
}
