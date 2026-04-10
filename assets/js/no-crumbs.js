/**
 * No Crumbs - Vanilla JS Logic
 */
(function() {
    function initNoCrumbs() {
        var banner = document.getElementById('nc-cookie-banner');
        if (!banner) {
            return;
        }

        // Проверяем куки согласия
        if (document.cookie.indexOf('nc_accepted=1') !== -1) {
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
        }, 50);

        // Назначаем Event Listener на кнопку "ОК"
        var btn = document.getElementById('nc-cookie-accept');
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                // Задаем куки на 30 дней
                document.cookie = "nc_accepted=1; max-age=2592000; path=/; SameSite=Lax";

                // Скрываем баннер
                banner.classList.add('nc-hidden');
                banner.setAttribute('aria-hidden', 'true');

                // Окончательно удаляем из DOM
                setTimeout(function() {
                    if (banner && banner.parentNode) {
                        banner.parentNode.removeChild(banner);
                    }
                }, 400); 
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
