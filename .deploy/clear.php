<?php
$base = dirname(__DIR__);
shell_exec("php {$base}/artisan view:clear 2>&1");
shell_exec("php {$base}/artisan cache:clear 2>&1");
shell_exec("php {$base}/artisan config:clear 2>&1");
echo "Cache cleared.";
unlink(__FILE__);
