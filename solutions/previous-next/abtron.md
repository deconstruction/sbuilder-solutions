```php
    $ids = array();
    $pluginId = 5;
    $count = 2;
    $catId = '{CAT_ID}';
    
    if($cat = sql_assoc("SELECT link_src_cat_id FROM sb_catlinks WHERE link_el_id = ? AND link_src_cat_id != ? AND link_src_cat_id != 0 LIMIT 1", "{ID}", "{CAT_ID}")) {
        $catId = $cat[0]['link_src_cat_id'];
    }
    
    $startSql = str_replace(
        array('{pluginId}', '{catId}', '{elemId}'),
        array($pluginId, $catId, '{ID}'),
        'SELECT
        sbp.p_id
        FROM sb_plugins_{pluginId} sbp
        JOIN sb_catlinks sbcl ON sbp.p_id = sbcl.link_el_id
        JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_5" AND sbc.cat_id = {catId})'
    );
    
    $sql = sprintf('%s
        WHERE sbp.p_active = 1
        AND sbp.p_id < %d
        ORDER BY sbp.p_id DESC
        LIMIT %d
        ', $startSql, '{ID}', $count);
    
    $previous = sql_assoc($sql);
    
    if(!$previous) {
        $sql = sprintf('%s
            WHERE sbp.p_active = 1
            AND sbp.p_id != %d
            ORDER BY sbp.p_id DESC
            LIMIT %d
            ', $startSql, '{ID}',  $count);
        
        $previous = sql_assoc($sql);
    }
    
    if(isset($_GET['test'])) var_dump('previous', $previous);
    
    if(is_array($previous)) {
        foreach($previous as $item) {
            $ids[] = $item['p_id'];
        }
    }
    
    $count = 3 - count($previous);
    
    $sql = sprintf('%s
        WHERE sbp.p_active = 1
        AND sbp.p_id > %d
        AND sbp.p_id NOT IN (%s)
        ORDER BY sbp.p_id DESC
        LIMIT %d
        ', $startSql, '{ID}', implode(',', $ids), $count);
    
    $next = sql_assoc($sql);
    
    if(!$next) {
        $sql = sprintf('%s
            WHERE sbp.p_active = 1
            AND sbp.p_id != %d
            ORDER BY sbp.p_id
            LIMIT %d
            ', $startSql, '{ID}',  $count);
        
        $next = sql_assoc($sql);
    }
    
    if(isset($_GET['test'])) var_dump('next', $next);
    
    if(is_array($next)) {
        foreach($next as $item) {
            $ids[] = $item['p_id'];
        }
    }
    
    if(count($ids) > 0) {
        $query = array(
            'p_f_5_id' => implode(',', $ids),
            'cat_id' => '{CAT_ID}',
            time(),
        );
        
        echo file_get_contents('https://www.abtronspb.ru/include/products.php?' . http_build_query($query));
    }
```
