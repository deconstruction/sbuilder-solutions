# Пример перелинковки 

```php
<?php if(isset($_GET['test'])) { ?>
<pre><code>
<?php
    $previous = sql_assoc('
        SELECT sb1.p_url, sb1.p_title, sbc.cat_url FROM sb_plugins_1 sb1
        JOIN sb_catlinks sbcl ON sb1.p_id = sbcl.link_el_id
        JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_1" AND sbc.cat_id = ?)
        WHERE sb1.p_id < ?
        ORDER BY sb1.p_id DESC
        LIMIT 1;
        ',
        '{CAT_ID}',
        '{ID}'
    );
    
    if(!$previous) {
        $previous = sql_assoc('
            SELECT sb1.p_url, sb1.p_title, sbc.cat_url FROM sb_plugins_1 sb1
            JOIN sb_catlinks sbcl ON sb1.p_id = sbcl.link_el_id
            JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_1" AND sbc.cat_id = ?)
            ORDER BY sb1.p_id DESC
            LIMIT 1;
            ',
            '{CAT_ID}',
            '{ID}'
        );
    }
    
    $previous = array_shift($previous);
    
    $next = sql_assoc('
        SELECT sb1.p_url, sb1.p_title, sbc.cat_url FROM sb_plugins_1 sb1
        JOIN sb_catlinks sbcl ON sb1.p_id = sbcl.link_el_id
        JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_1" AND sbc.cat_id = ?)
        WHERE sb1.p_id > ?
        ORDER BY sb1.p_id DESC
        LIMIT 1;
        ',
        '{CAT_ID}',
        '{ID}'
    );
    
    // var_dump("{CAT_ID}", $next);
    
    if(!$next) {
        $next = sql_assoc('
            SELECT sb1.p_url, sb1.p_title, sbc.cat_url FROM sb_plugins_1 sb1
            JOIN sb_catlinks sbcl ON sb1.p_id = sbcl.link_el_id
            JOIN sb_categs sbc ON (sbcl.link_cat_id = sbc.cat_id AND sbc.cat_ident = "pl_plugin_1" AND sbc.cat_id = ?)
            ORDER BY sb1.p_id
            LIMIT 1;
            ',
            '{CAT_ID}',
            '{ID}'
        );
    }
    
    
    $next = array_shift($next);
    
    ?>
</code></pre>

<?php if($previous) { ?>
<a href="/article/{CAT_URL}/<?= $previous['p_url'] ?>/?test&<?= time() ?>"><?= $previous['p_title'] ?></a>
<?php } ?>
/
<?php if($next) { ?>
<a href="/article/{CAT_URL}/<?= $next['p_url'] ?>/?test&<?= time() ?>"><?= $next['p_title'] ?></a>
<?php } ?>
<?php } ?>
```
