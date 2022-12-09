# Выгрузка элементов из каталога пример

```php

SELECT sbp.* FROM sb_plugins_63 sbp
JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
JOIN sb_categs sbct ON (sbcl.link_cat_id = sbct.cat_id AND sbct.cat_ident = 'pl_plugin_63' AND sbct.cat_id = 3761)

```
