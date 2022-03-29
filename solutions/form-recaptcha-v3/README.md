# Recaptcha V3

* [Официальная документация Google](https://developers.google.com/recaptcha/docs/v3).

* [Получить ключи](https://www.google.com/recaptcha/admin/create).

## Требования
* PHP выше 5.2.

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
<scrpt async src="/assets/js/recaptcha.js"></scrpt> 
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

***secret key*** - подствьте ключ из поля *секретный ключ*.
```php
$recaptcha = new \Recaptcha\Recaptcha('secret key');

// Вариант 1
$error = $recaptcha->check(0.5, $_POST['recaptcha_token']);
// Вариант 2, проверка пост поля происходит в методе.
$error = $recaptcha->checkFromPost(0.5);

$f_value = $recaptcha->response;
$f_value .= PHP_EOL . PHP_EOL;
$f_value .= print_r($_POST, 1); 
```
![Новое поле для Recaptcha](images/field-in-module-2.jpg)




