<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.urlFor.php
 * Type:     function
 * Name:     urlFor
 * Purpose:  outputs url for a function with the defined name method
 * @version   0.1.2
 * @package   SlimViews
 * -------------------------------------------------------------
 */
function smarty_function_urlFor($params, $template)
{
    $name = isset($params['name']) ? $params['name'] : '';
    $app  = /*isset($params['app']) ? $params['app'] :*/ \Fobia\Application::getInstance();

    $url = $app->urlFor($name);

	if (isset($params['options']))
	{
		switch (gettype($params['options'])) {
			case 'array':
				$opts = $params['options'];
				break;

			case 'string':
				$options = explode('|', $params['options']);
				foreach ($options as $option) {
					list($key, $value) = explode('.', $option);
					$opts[$key] = $value;
				}
				break;

			default:
				throw new \Exception('Options parameter is of unknown type, provide either string or array');
		}

		$url = $app->urlFor($name, $opts);
	}

	return $url;
}
