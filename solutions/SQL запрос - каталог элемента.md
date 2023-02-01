```sql
SELECT * FROM `sb_plugins_1` sbp
JOIN sb_catlinks sbcl ON sbcl.link_el_id = sbp.p_id
JOIN sb_categs sbct ON (sbct.cat_id = sbcl.link_cat_id AND sbct.cat_ident = 'pl_plugin_1')
WHERE sbp.p_id = 2
```

`sb_plugins_1` - меняем на нужный модуль
`pl_plugin_1` - меняем на нужный модуль
`sbp.p_id = 2` - меняем на нужный айдишник эелемента
