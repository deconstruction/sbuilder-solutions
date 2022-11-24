document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('[action="/ajax/"]');
    const isDebug = document.location.search.indexOf('debug_ajax') !== -1;

    if (isDebug) {
        console.info(`Load script for ajax forms. Forms finded: ${forms.length}`);
        if (forms.length !== 0) {
            console.info(forms);
        }
    }

    
    forms.forEach((form, i) => {
        let formId = i;
        if (form.getAttribute('id')) {
            formId = form.getAttribute('id');
        }

        const eventName = `ajax_form_${formId}`;

        if (isDebug) {
            console.info(`Event name ajax form: ${eventName}`);
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                cache: 'no-cache',
            })
                .then(r => {
                    if(r.url.indexOf('?pl') === -1) {
                        throw Error('Форма не была отправлена! Проверьте наличие pl_plugin_ident поля в форме отправки или обязательные поля в технической форме.');
                    }

                    return r.text();
                })
                .then(() => document.dispatchEvent(new CustomEvent(eventName, {detail:form})))
                .catch(e => console.error(e));
        });
    });
});
