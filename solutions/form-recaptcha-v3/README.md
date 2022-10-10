# Recaptcha V3

* [Официальная документация Google](https://developers.google.com/recaptcha/docs/v3).

* [Получить ключи](https://www.google.com/recaptcha/admin/create).

## Требования

* PHP >= 5.3.

## Ключи

![Google Recaptcha Keys](images/keys.jpg)

Ключ сайта необходим для скрипта JS.

Добавьте в ```<head></head>``` сайта следующий мета тег с ключом сайта:

```html

<meta name="recaptcha-public-key" content="Ключ сайта">
```

## Установка

1. Для начала закачиваем исходники в CMS. Папку `extensions` необходимо необходимо загрузить в папку `/cms`.

4. На страницу, где форма, необходимо установить скрипт.

```html

<script src="/assets/js/recaptcha.js" defer></script> 
```

3. На необходимую форму необходимо повесить тег: **data-recaptcha**

```html

<form data-recaptcha></form>
```

*В данной форме после проверки рекаптчей должно появится скрытое поле **recaptcha_token***.
![Скрытое поле в форме отправки](images/field-in-form.jpg)

## Настройка модуля

Чтобы произвести проверку на спам, необходимо в *нужном модуле* произвести следующие настройки:

1. Добавить поле которое будет отвечать за проверку на спам. Выводить в форме на сайте нет необходимости.
   ![Новое поле для рекаптчи](images/field-in-module.jpg)


2. Сделать поле **обязательным**, и добавить код проверки.

***secret key*** - подставьте ключ из поля *секретный ключ*.

```php
if(empty($_POST['recaptcha_token']) || !class_exists('\Recaptcha\Recaptcha')) {
    $error = true;
} else {
    $recaptcha = new \Recaptcha\Recaptcha('secret key');

    $error = $recaptcha->check(0.5, $_POST['recaptcha_token']);

    $f_value = $recaptcha->response;
    $f_value .= PHP_EOL . PHP_EOL;
    $f_value .= print_r($_POST, 1); 
}
```

![Новое поле для Recaptcha](images/field-in-module-2.jpg)


Если на этом же модуле работает не только форма а и вывод карточек, возникает ошибка добавление карточек ( Некорректно заполнено поле "recaptcha"! ) для решения этой проблемы нужно:
1. Добаить поле PHP код recaptcha_admin в поле ( PHP-код (выполняется в момент формирования HTML-кода окна) ) прописать:
```php

echo '<input type="hidden" name="user_f_8" value="1" />';

```
8 - id поля

2. В поле recaptcha добавить условие:
```php
if(isset($_POST['user_f_8'])) {
    $error = false;
} else if(empty($_POST['recaptcha_token']) || !class_exists('\Recaptcha\Recaptcha')) {
    $error = true;
} else {
    $recaptcha = new \Recaptcha\Recaptcha('6LdSyU8iAAAAAKw4jPGHKs8wEuCSzwpLWiQXy2RG');

    $error = $recaptcha->check(0.5, $_POST['recaptcha_token']);

    $f_value = $recaptcha->response;
    $f_value .= PHP_EOL . PHP_EOL;
    $f_value .= print_r($_POST, 1); 
}

```

