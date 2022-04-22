# Правим маршрутизацию

Данный скрипт кидаем в текстовик и добавляем в самое начало страницы

Первое условие проверяет на соответствие регистра, и если нет соответствия - редиректит на урл с нижним регистром

Второе условие проверяем роут на использование айди вместо чпу. Если условие выполняется то выдаем 404 ошибку.

```php
foreach($GLOBALS['_GET'] as $key => $route) {
    if(strpos($key, '_scid') !== false || strpos($key, '_sid') !== false) {
            
        if($route !== strtolower($route)) {
            header('Location: ' . strtolower($GLOBALS['_SERVER']['REQUEST_URI']));
            
            break;
        }
            
        if(is_numeric($route)) {
            sb_404();
                
            break;
        }
            
    }
}
```
