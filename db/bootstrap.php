<?php

use Src\Application;
use Src\Plugins\AuthPlugin;
use Src\Plugins\DbPlugin;
use Src\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;