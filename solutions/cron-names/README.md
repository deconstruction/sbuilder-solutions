# Полные названия внешних скриптов в планировщике заданий

1. Перейдите в файл `/cms/plugins/pl_external_script/pl_external_script.h.php`
2. Найдите строку **17** со следующим содержимым:
```php
$_SESSION['sbPlugins']->addToCron('pl_external_script/cron/pl_external_script.php', 'fExternal_Script_Cron_Refresh('.$row[0].')', sprintf(PL_EXTERNAL_SCRIPT_H_CRON, sb_wordwrap($row[1], 20, '...', true)), PL_EXTERNAL_SCRIPT_DESC_CRON);
```
3. Замените эту строку на следующее:
```php
$_SESSION['sbPlugins']->addToCron('pl_external_script/cron/pl_external_script.php', 'fExternal_Script_Cron_Refresh('.$row[0].')', sprintf(PL_EXTERNAL_SCRIPT_H_CRON, $row[1]), PL_EXTERNAL_SCRIPT_DESC_CRON);
```
