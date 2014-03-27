<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.webPath.php
 * Type:     function
 * Name:     webPath
 * Purpose:  outputs url for a function with the defined name method
 * version   0.1.0
 * package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_webPath($params, $template)
{
    $withUri = isset($params['withUri']) ? $params['withUri'] : false;
    $app     = isset($params['app']) ? $params['app'] : $_ENV['app'];

    $uri = $app->config('webpath');

    if ($withUri) {
        $uri = $app->request->getUrl().$uri;
    }

    return $uri;
}
