<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.siteUrl.php
 * Type:     function
 * Name:     siteUrl
 * Purpose:  outputs url for a function with the defined name method
 * version   0.1.0
 * package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_siteUrl($params, $template)
{
    $withUri = isset($params['withUri']) ? $params['withUri'] : true;
    $app     = isset($params['app']) ? $params['app'] : $_ENV['app'];
    $url     = isset($params['url']) ? $params['url'] : '';

    $req = $app->request;
    $uri = $req->getUrl();

    if ($withUri) {
        $uri .= $req->gerUrl();
    }

    return $uri . '/' . ltrim($url, '/');
}
