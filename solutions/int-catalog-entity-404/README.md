```php
if(isset($_GET['globals'])) {
        var_dump($GLOBALS);
    }
    
    $catalogs = array(
        'pl15_scid',
        'pl15_sid',        
        'users_scid',   
        'pl2_scid',
        'pl2_sid',
        'pl1_scid',
        'pl1_sid',
    );
    
    foreach($catalogs as $catalog) {
        if(isset($GLOBALS['_GET'][$catalog]) && is_numeric($GLOBALS['_GET'][$catalog])) {
            sb_404();
        }
    }
```
