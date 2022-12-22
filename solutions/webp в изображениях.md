# Вывод превью webp изображений

Идем в файл `cms/lib/layout/sbLayoutImage.inc.php`
Добавляем сразу после `87` сроки следующее:
```php
if (strpos($this->mValue, '.webp') !== false) {
  $ar = array();
  $ar[0] = 150;
  $ar[2] = 1;
}
```
