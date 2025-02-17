<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

if (isset($_SERVER['REQUEST_URI']) &&
 preg_match('/\.(?:css|json|js|png|jpg|jpeg|gif|ttf|woff|woff2)(\?.+)?$/i', $_SERVER['REQUEST_URI'])) {
    return false; // serve the requested resource as-is.
}

defined('YII_ENV') || define('YII_ENV', 'test');
defined('YII_ENV_TEST') || define('YII_ENV_TEST', true);


require(__DIR__ . '/protected/vendor/autoload.php');
require(__DIR__ . '/protected/vendor/yiisoft/yii2/Yii.php');

$config = yii\helpers\ArrayHelper::merge(
    // add more configurations here
    (is_readable(__DIR__ . '/protected/humhub/tests/codeception/config/dynamic.php')) ? require(__DIR__ . '/protected/humhub/tests/codeception/config/dynamic.php') : [],
    
    require(__DIR__ . '/protected/humhub/tests/codeception/config/acceptance.php')
);

require_once './protected/vendor/codeception/codeception/autoload.php';

include './protected/humhub/tests/c3.php';

(new humhub\components\Application($config))->run();
