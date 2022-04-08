```php
    if(isset($_GET['globals'])) {
        var_dump($GLOBALS['_GET']);
    }
    
    foreach($GLOBALS['_GET'] as $key => $value) {
        if(strpos($key, 'id') !== false && is_numeric($value)) {
            sb_404();
        }
    }
```
