<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.baseUrl.php
 * Type:     function
 * Name:     baseUrl
 * Purpose:  outputs url for a function with the defined name method
 * version   0.1.2
 * package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_baseUrl($params, $template)
{
    $withUri = isset($params['withUri']) ? $params['withUri'] : true;
    $app     = /*isset($params['app']) ? $params['app'] :*/ \Fobia\Application::getInstance();

    /* @var $req Slim\Http\Request */
    $req = $app->request;

    $uri = $req->getUrl();

//    if ($withUri) {
//        $uri .= $req->getUrl();
//    }

    return $uri;
}
