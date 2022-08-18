document.addEventListener('DOMContentLoaded', () => {
    const action = '/ajax/';

    console.log(new Date);

    document.querySelectorAll('[data-ajax-form]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch(action, {
                method: 'POST',
                body: new FormData(form),
                cache: 'no-cache',
            })
                .then(r => {
                    if(r.url.indexOf('?pl') === -1) {
                        throw Error('Форма не была отправлена! Проверьте наличие pl_plugin_ident поля в форме отправки.');
                    }

                    return r.text();
                })
                .then(r => {
                    form.innerHTML = r;
                })
                .catch(e => console.error(e));
        });
    });
});