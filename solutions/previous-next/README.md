# Пример перелинковки 

```php
    $ids = array();
    $pluginId = 5;
    $count = 2;
    
    $sql = sprintf('
        SELECT sbp.p_id FROM sb_plugins_%d sbp
        JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
        JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_%d" AND sbc.cat_id = %d)
        WHERE sbp.p_active = 1
        AND sbp.p_id < %d
        ORDER BY sbp.p_id DESC
        LIMIT %d
        ', $pluginId, $pluginId, '{CAT_ID}', '{ID}', $count);
    
    $previous = sql_assoc($sql);
    
    if(!$previous) {
        $sql = sprintf('
            SELECT sbp.p_id FROM sb_plugins_%d sbp
            JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
            JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_%d" AND sbc.cat_id = %d)
            WHERE spb.p_active = 1
            ORDER BY sbp.p_id DESC
            LIMIT %d
            ', $pluginId, $pluginId, '{CAT_ID}', $count);
        
        $previous = sql_assoc($sql);
    }
    
    if(is_array($previous)) {
        foreach($previous as $item) {
            $ids[] = $item['p_id'];
        }
    }
    
    $count = count($previous) === 1 ? 2 : 1;
    
    $sql = sprintf('
        SELECT sbp.p_id FROM sb_plugins_%d sbp
        JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
        JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_%d" AND sbc.cat_id = %d)
        WHERE sbp.p_active = 1
        AND sbp.p_id > %d
        ORDER BY sbp.p_id DESC
        LIMIT %d
        ', $pluginId, $pluginId, '{CAT_ID}', '{ID}', $count);
    
    $next = sql_assoc($sql);
    
    if(!$next) {
        $sql = sprintf('
            SELECT sbp.p_id FROM sb_plugins_%d sbp
            JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
            JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_%d" AND sbc.cat_id = %d)
            WHERE sbp.p_active = 1
            ORDER BY sbp.p_id
            LIMIT %d
            ', $pluginId, $pluginId, '{CAT_ID}', $count);
        
        $next = sql_assoc($sql);
    }
    
    if(is_array($next)) {
        foreach($next as $item) {
            $ids[] = $item['p_id'];
        }
    }
    
    echo file_get_contents('/include/products.php?p_f_5_id=' . implode(',', $ids) . '&' . time());
```

# Чистый SQL

```sql
SELECT *
FROM sb_plugins_5 sbp
JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_5" AND sbcl.link_cat_id = 60)
WHERE sbp.p_active = 1 AND sbp.p_id < 620
ORDER BY sbp.p_id DESC
LIMIT 2
```
