# Правка бага с неймспейсами для расширений в папке /cms/extensions/

В файле `/cms/kernel/prog/init.inc.php` после строки под номером `739` добавить следующую строку:
```php
$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
```

В итоге метод должен выглядеть так:

```php
function sb_ext_autoload($class)
{ 
    if(!class_exists($class) && is_dir(SB_CMS_EXT_PATH))
    {
        $dirs = scandir(SB_CMS_EXT_PATH);
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        if(!file_exists(SB_CMS_EXT_PATH . '/' . $class .'.php'))
        {
            foreach($dirs as $dir)
            {
                if($dir == '.' || $dir == '..' || !is_dir(SB_CMS_EXT_PATH . '/' . $dir))
                {
                    continue;
                }
                elseif(is_file(SB_CMS_EXT_PATH . '/' . $dir . '/' . $class . '.php'))
                {
                    require_once SB_CMS_EXT_PATH . '/' . $dir . '/' . $class . '.php';
                }
            }
        }
        else
        {
            require_once SB_CMS_EXT_PATH . '/' . $class .'.php';
        }
    }
}
```
