document.addEventListener('DOMContentLoaded', async () => {
    const getFormId = (form) => {
        let formId = '';

        if (form.dataset.ajax !== undefined) {
            formId = form.dataset.ajax;
        }

        if (form.getAttribute('id')) {
            formId = form.getAttribute('id');
        }

        if (formId !== '') {
            formId = `_${formId}`;
        }

        return formId;
    }

    const action = '/ajax/';
    const forms = document.querySelectorAll(`[action="${action}"]`);
    const isDebug = document.location.search.indexOf('debug_ajax') !== -1;
    const debugData = [];

    let dataPluginsIdent = '';
    if(isDebug) {
        let response  = await fetch(action);
        dataPluginsIdent  = await (response.text());
    }


    forms.forEach(form => {
        const eventSended = `ajax${getFormId(form)}`;
        const eventSuccess = `${eventSended}_success`;
        const eventFailed = `${eventSended}_failed`;

        const pluginIdent = form.querySelector('[name="pl_plugin_ident"]');

        debugData.push({
            form: form,
            'Sended event': eventSended,
            'Success event': eventSuccess,
            'Failed event': eventFailed,
            'pl_plugin_ident': pluginIdent !== null ? pluginIdent.value : false,
            'has "pl_plugin_ident" in action page': pluginIdent !== null ? dataPluginsIdent.indexOf(pluginIdent.value) !== -1 : false,
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            document.dispatchEvent(new CustomEvent(eventSended, {detail: form}));

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                cache: 'no-cache',
            })
                .then(r => {
                    if (r.url.indexOf('?pl') === -1) {
                        throw Error('Форма не была отправлена! Проверьте наличие pl_plugin_ident поля в форме отправки или обязательные поля в технической форме.');
                    }

                    return r.text();
                })
                .then(() => document.dispatchEvent(new CustomEvent(eventSuccess, {detail: form})))
                .catch(e => {
                    console.error(e);
                    document.dispatchEvent(new CustomEvent(eventFailed, {detail: form}));
                });
        });
    });

    if (isDebug) {
        console.group('Ajax forms.');
        console.table(debugData);
        console.groupEnd();
    }
});
