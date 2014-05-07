<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.siteUrl.php
 * Type:     function
 * Name:     siteUrl
 * Purpose:  outputs url for a function with the defined name method
 * version   0.1.2
 * package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_siteUrl($params, $template)
{
    $withUri = isset($params['withUri']) ? $params['withUri'] : false;
    $url     = isset($params['url']) ? $params['url'] : '';

    $app = \Fobia\Application::getInstance();
    $req = $app->request;
    $uri = $app->config('webpath'); //$req->getUrl();

    if ($withUri) {
       $uri = $req->getUrl() . $uri;
    }

    return $uri . '/' . ltrim($url, '/');
}
