<?php
/**
 * Slim - a micro PHP 5 framework
 *
 * @author      Josh Lockhart
 * @author      Andrew Smith
 * @link        http://www.slimframework.com
 * @copyright   2013 Josh Lockhart
 * @version     0.1.0
 * @package     SlimViews
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Slim\Views;

use Slim\App;

class TwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'slim';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('urlFor', array($this, 'urlFor')),
            new \Twig_SimpleFunction('baseUrl', array($this, 'base')),
            new \Twig_SimpleFunction('siteUrl', array($this, 'site')),
            new \Twig_SimpleFunction('webPath', array($this, 'webPath')),
        );
    }

    public function urlFor($name, $params = array())
    {
        return $_ENV['app']->urlFor($name, $params);
    }

    public function site($url, $withUri = true)
    {
        return $this->base($withUri) . '/' . ltrim($url, '/');
    }

    public function base($withUri = true)
    {
        $req = $_ENV['app']->request();
        $uri = $req->getUrl();

        if ($withUri) {
            $uri = $req->getPath();
        }
        return $uri;
    }

    public function webPath($withUri = true)
    {
        $app = $_ENV['app'];
        $uri = $app->config('webpath');
        if ($withUri) {
            $uri = $app->request->getUrl().$uri;
        }
        return $uri;
    }
}
