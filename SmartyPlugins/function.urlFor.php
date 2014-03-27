<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.urlFor.php
 * Type:     function
 * Name:     urlFor
 * Purpose:  outputs url for a function with the defined name method
 * version   0.1.0
 * package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_urlFor($params, $template)
{
    $name = isset($params['name']) ? $params['name'] : '';
    $app  = isset($params['app']) ? $params['app'] : $_ENV['app'];
    /* @var $app \Slim\App */
    $url = $app->urlFor($name);

    if (isset($params['options']))
    {
        $options = explode('|', $params['options']);
        foreach ($options as $option) {
            list($key, $value) = explode('.', $option);
            $opts[$key] = $value;
        }

        $url = $app->urlFor($name, $opts);
    }

    return $url;
}
