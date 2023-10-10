document.addEventListener('DOMContentLoaded', () => {
    console.info('yandex smart captcha script loaded');

    const metaKey = document.querySelector('meta[name="smart-captcha-public-key"]')

    if (metaKey !== null) {
        const key = metaKey.getAttribute('content');

        const script = document.createElement('script');
        script.onload = function () {

            const forms = document.querySelectorAll('[data-smart-captcha]');

            console.log('Forms count: ' + forms.length);

            forms.forEach((form, i) => {
                console.log(form);
                const containerId = 'captcha-container-' + i;

                const container = document.createElement('div');
                container.setAttribute('id', containerId);
                form.appendChild(container);

                const widgetId = window.smartCaptcha.render(containerId, {
                    sitekey: key,
                    invisible: true,
                    callback: (token) => {
                        console.log(token);

                      // Здесь нужно добавить обработчик

                        form.submit();
                    },
                });

                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    window.smartCaptcha.execute(widgetId);
                })
            })
        };

        // Set the src of the script element to the recaptcha API
        script.src = 'https://smartcaptcha.yandexcloud.net/captcha.js';

        // Append the script element to the head of the document
        document.head.appendChild(script);
    } else {
        console.warn('Yandex Smart Captcha not loaded!!!');
    }
});
