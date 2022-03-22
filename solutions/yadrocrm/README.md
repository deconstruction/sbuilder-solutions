# YadroCRM

## Установка
1. [sYadroCRM.php](src/sYadroCRM.php) необходимо изменить константу **KEY** на нужный ключ и загрузить в папку /cms/extensions/.
2. Далее в обработчике форм добавляем следующее:

```php
sYadroCRM::push();
```
