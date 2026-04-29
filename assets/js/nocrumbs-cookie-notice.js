/**
 * No Crumbs - Vanilla JS Logic
 */
(function() {
    /**
     * Проверяет наличие конкретного cookie по имени и значению.
     *
     * @param {string} name  Имя cookie.
     * @param {string} value Ожидаемое значение.
     * @return {boolean}
     */
    function hasCookie(name, value) {
        return document.cookie.split('; ').some(function(c) {
            return c === name + '=' + value;
        });
    }

    function initNoCrumbs() {
        var banner = document.getElementById('nc-cookie-banner');
        if (!banner) {
            return;
        }

        // Проверяем куки согласия
        if (hasCookie('nc_accepted', '1')) {
            // Если куки уже есть, мы просто удаляем невидимый элемент из DOM
            if (banner.parentNode) {
                banner.parentNode.removeChild(banner);
            }
            return;
        }

        // Если куки нет — показываем баннер, удаляя класс сокрытия
        setTimeout(function() {
            banner.classList.remove('nc-hidden');
            banner.removeAttribute('aria-hidden');

            // Управление фокусом: перемещаем фокус внутрь диалога (a11y)
            var btn = document.getElementById('nc-cookie-accept');
            if (btn) {
                btn.focus();
            }
        }, 50);

        // Назначаем Event Listener на кнопку "ОК"
        var btn = document.getElementById('nc-cookie-accept');
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                // Задаем куки на 30 дней с Secure-флагом на HTTPS
                var secure = location.protocol === 'https:' ? '; Secure' : '';
                document.cookie = "nc_accepted=1; max-age=2592000; path=/; SameSite=Lax" + secure;

                // Скрываем баннер
                banner.classList.add('nc-hidden');
                banner.setAttribute('aria-hidden', 'true');

                // Окончательно удаляем из DOM после завершения CSS transition
                function removeBanner() {
                    if (banner && banner.parentNode) {
                        banner.parentNode.removeChild(banner);
                    }
                    banner.removeEventListener('transitionend', removeBanner);
                }
                banner.addEventListener('transitionend', removeBanner);
            });
        }
    }

    // Защита от Race Condition (состояния гонки).
    // Если скрипт загружен асинхронно или в футере, DOMContentLoaded может уже сработать до загрузки JS.
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNoCrumbs);
    } else {
        initNoCrumbs(); // Запускаем сразу, если DOM уже готов
    }
})();
