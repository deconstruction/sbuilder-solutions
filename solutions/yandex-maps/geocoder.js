const yandexMapGeoCoder = (geocode, parameters = null) => {
    const params = new URLSearchParams;
    const url = 'https://geocode-maps.yandex.ru/1.x/?';

    params.append('format', 'json');
    params.append('apikey', '***');
    params.append('geocode', geocode);

    if (typeof parameters === 'object' && parameters !== null) {
        for (const [key, value] of Object.entries(parameters)) {
            params.has(key) ? params.set(key, value) : params.append(key, value);
        }
    }

    return fetch(url + params.toString()).then(r => r.json());
}