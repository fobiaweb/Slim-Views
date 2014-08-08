<?php

namespace Slim\Views;

/**
 * View
 *
 * This class is responsible for fetching and rendering a template with
 * a given set of data. Although the `\Slim\View` class is itself
 * capable of rendering PHP templates, it is highly recommended that you
 * subclass `\Slim\View` for use with popular PHP templating libraries
 * such as Twig, Smarty, or Mustache.
 *
 * If you do choose to create a subclass of `\Slim\View`, the subclass
 * MUST override the `render` method with this exact signature:
 *
 *     public render(string $template);
 *
 * The `render` method MUST return the rendered output for the template
 * identified by the `$template` argument. The `$template` argument will
 * contain the template file pathname *relative to* the templates base
 * directory for the current view instance.
 *
 * The `Slim-Views` repository contains pre-made custom views for
 * Twig and Smarty, two of the most popular PHP templating libraries.
 *
 * See: https://github.com/codeguy/Slim-Views
 *
 * Also, `\Slim\View` extends `\Slim\Container` so
 * that you may use the convenient `\Slim\Container` interface just
 * as you do with other Slim application data sets (e.g. HTTP headers,
 * HTTP cookies, etc.)
 *
 * @package Slim
 * @author  Josh Lockhart
 * @since   1.0.0
 */
class View extends \Slim\View
{

    /**
     * Render template
     *
     * @var    string            $template Pathname of template file relative to templates directory
     * @return string                      The rendered template
     * @throws \RuntimeException           If resolved template pathname is not a valid file
     */
    protected function render($template, array $data = array())
    {
        // Resolve and verify template file
        $templatePathname = $this->templateDirectory . DIRECTORY_SEPARATOR . ltrim($template, DIRECTORY_SEPARATOR);
        if (!is_file($templatePathname)) {
            throw new \RuntimeException("Cannot render template `$templatePathname` because the template does not exist. Make sure your view's template directory is correct.");
        }

        $data = array_merge($this->all(), $data);
        extract($data);
        ob_start();
        require $templatePathname;

        // Return temporary output buffer content, destroy output buffer
        return ob_get_clean();
    }
}
