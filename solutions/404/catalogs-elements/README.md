# Заперт вывода любых каталогов и любого элемента на странице
```php
foreach($GLOBALS['_GET'] as $k => $v) {
    if(strpos($k, 'id') !== false) {
        sb_404();
    }
}
```

# Заперт вывода любого каталога на странице
```php
foreach($GLOBALS['_GET'] as $k => $v) {
    if(strpos($k, 'scid') !== false) {
        sb_404();
    }
}
```

# Заперт вывода любого элемента на странице
```php
foreach($GLOBALS['_GET'] as $k => $v) {
    if(strpos($k, 'sid') !== false) {
        sb_404();
    }
}
```