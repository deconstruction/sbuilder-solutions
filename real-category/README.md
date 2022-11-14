# Реальная категория элемента

Если элмент имеет ссылку, то ссылка указывает на каталог в которой она находится. Скрипт ниже беред данные оригинальной категории.

```php
  $cat = '{CAT_URL}';
    
     $catLink = sql_assoc("SELECT * FROM sb_catlinks WHERE link_el_id = ? AND link_src_cat_id != ? AND link_src_cat_id != 0 LIMIT 1", "{ID}", "{CAT_ID}");
    
    if($catLink) {
        $originalCat = sql_assoc("SELECT cat_url FROM sb_categs WHERE cat_id = ? LIMIT 1", $catLink[0]['link_src_cat_id']);
        
        if($originalCat) {
            $cat = $originalCat[0]['cat_url'];
        }
    }
```
