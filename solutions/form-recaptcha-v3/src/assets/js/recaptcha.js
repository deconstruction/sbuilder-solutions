/**
 * Recaptcha V3 for SBuilder platform
 *
 * Version: 1.1.1
 */

['load', 'recaptcha'].forEach(event => {
    window.addEventListener(event, () => {

        console.log('recaptcha script loaded');

        const forms = document.querySelectorAll('[data-recaptcha]');
        const metaKey = document.querySelector('meta[name="recaptcha-public-key"]')

        if (forms.length > 0 && metaKey !== null) {
            const recaptchaClientKey = metaKey.getAttribute('content');

            const script = document.createElement('script');
            script.onload = function () {
                grecaptcha.ready(function () {
                    grecaptcha.execute(recaptchaClientKey, {action: 'homepage'}).then(function (token) {
                        forms.forEach(form => {

                            // Созадем инпут для токена и присваеваем ему полученый токен
                            let input = form.querySelector('[name="recaptcha_token"]');

                            if (input === null) {
                                input = document.createElement('input');
                                input.setAttribute("type", "hidden");
                                input.setAttribute("name", "recaptcha_token");
                                form.appendChild(input);
                            }

                            input.setAttribute("value", token);

                            // Создаем инпуты куда помещаем информацию о текущей странице
                            const page = document.createElement('input');
                            page.setAttribute("type", "hidden");
                            page.setAttribute("name", "current_page");
                            page.setAttribute("value", window.location.href);
                            form.appendChild(page);

                            // Создаем инпуты куда помещаем информацию о времени создания
                            const date = document.createElement('input');
                            date.setAttribute("type", "hidden");
                            date.setAttribute("name", "current_date");
                            date.setAttribute("value", new Date);
                            form.appendChild(date);
                        });
                    });
                });
            };

            script.src = 'https://www.google.com/recaptcha/api.js?render=' + recaptchaClientKey;

            document.head.appendChild(script);
        }
    });
});