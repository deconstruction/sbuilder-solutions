Данный скрипт сам очищает корзину. Поэтому не нужно отдельно ставить отчистку корзины.

```js
const uuidv4 = () => {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

const simpleCartConfig = {

    // Укажите ID плагина который принимает заказы
    pluginId: 3,

    isOrderCreated: () => {
        return window.location.search.indexOf(`pl${this.pluginId}_id`) != -1
    }
}

// Объект электронной коммерции яндекс метрики
const eCommerce = {

    // Добавить
    add: (id, name, category, price, quantity) => {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            "ecommerce": {
                "add": {
                    "actionField": {
                        "id": uuidv4()
                    },
                    "products": [{
                        'id': id,
                        'name': name,
                        'category': category,
                        'price': price,
                        'quantity': quantity
                    }]
                }
            }
        });
    },

    // Удалить
    remove: (id, name, category, price, quantity) => {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            "ecommerce": {
                "remove": {
                    "actionField": {
                        "id": uuidv4()
                    },
                    "products": [{
                        'id': id,
                        'name': name,
                        'category': category,
                        'price': price,
                        'quantity': quantity === 0 ? 1 : quantity
                    }]
                }
            }
        });
    },

    purchase: (products) => {
        window.dataLayer = window.dataLayer || [];

        window.dataLayer.push({
            "ecommerce": {
                "purchase":
                {
                    "actionField": {
                        "id": uuidv4()
                    },
                    "products": products
                }
            }
        });
    }
}

// Локальное хранилище для хранения состояния корзины до обновления содержимого корзины
const beforeLocalStorage = {
    name: 'simpleCart_items_before',

    // Обновить локальное хранилище
    update: () => {
        products = {};

        simpleCart.each(item => {
            products[item.get('id')] = simpleCart.extend(item.fields(), item.options());
        });

        localStorage.setItem(beforeLocalStorage.name, JSON.stringify(products));
    },

    // Получить из хранилища данные
    get: () => {
        products = {};
        const items = localStorage.getItem(beforeLocalStorage.name);

        if (!items) {
            return products;
        }

        simpleCart.each(JSON.parse(items), function (oldItem) {
            products[oldItem.id] = oldItem;
        });

        return products;
    }
}

simpleCart.bind('beforeAdd', function (item) {
    eCommerce.add(
        item.get('uid'),
        item.get('name'),
        item.get('basecategory'),
        item.get('price'),
        item.get('quantity')
    );
});

simpleCart.bind('beforeRemove', function (item) {
    if (simpleCartConfig.isOrderCreated()) {
        eCommerce.remove(
            item.get('uid'),
            item.get('name'),
            item.get('basecategory'),
            item.get('price'),
            item.get('quantity')
        );
    }
});

simpleCart.bind('beforeOrder', () => {
    const products = [];

    simpleCart.each(item => {
        products.push({
            'id': item.get('id'),
            'name': item.get('name'),
            'category': item.get('basecategory'),
            'price': item.get('price'),
            'quantity': item.get('quantity')
        });
    });

    console.log(products, products.length);

    if (products.length === 0) {
        return false;
    }

    eCommerce.purchase(products);

    return true;
});

simpleCart.bind('load', function () {

    beforeLocalStorage.update();

    simpleCart.bind('update', () => {
        simpleCart.each(item => {
            products = beforeLocalStorage.get();

            if (products[item.get('id')] === undefined) {
                return false;
            }

            const oldQuantity = products[item.get('id')].quantity;
            const newQuantity = item.get('quantity');

            if (oldQuantity !== newQuantity) {
                const diff = newQuantity - oldQuantity;

                if (diff > 0) {
                    eCommerce.add(
                        item.get('uid'),
                        item.get('name'),
                        item.get('basecategory'),
                        item.get('price'),
                        1
                    );
                }

                if (diff < 0) {
                    eCommerce.remove(
                        item.get('uid'),
                        item.get('name'),
                        item.get('basecategory'),
                        item.get('price'),
                        1
                    );
                }

                beforeLocalStorage.update();
            }
        });
    })
});

simpleCart.bind('load', function () {
    if (simpleCartConfig.isOrderCreated() && simpleCart.total() > 0) {
        const products = [];

        simpleCart.each(item => {
            products.push({
                'id': item.get('id'),
                'name': item.get('name'),
                'category': item.get('basecategory'),
                'price': item.get('price'),
                'quantity': item.get('quantity')
            });
        });

        eCommerce.purchase(products);

        simpleCart.empty();
    }
});
```
