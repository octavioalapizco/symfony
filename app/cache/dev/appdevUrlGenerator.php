<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


/**
 * appdevUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRouteNames = array(
       '_welcome' => true,
       '_demo_login' => true,
       '_security_check' => true,
       '_demo_logout' => true,
       'acme_demo_secured_hello' => true,
       '_demo_secured_hello' => true,
       '_demo_secured_hello_admin' => true,
       '_demo' => true,
       '_demo_hello' => true,
       '_demo_contact' => true,
       '_wdt' => true,
       '_profiler_search' => true,
       '_profiler_purge' => true,
       '_profiler_import' => true,
       '_profiler_export' => true,
       '_profiler_search_results' => true,
       '_profiler' => true,
       '_configurator_home' => true,
       '_configurator_step' => true,
       '_configurator_final' => true,
       'blog_home' => true,
       'view_post' => true,
       'blog_admin' => true,
       'blog_admin_blog' => true,
       'blog_admin_post' => true,
       'new_post' => true,
       'nuevo_post' => true,
       'save_post' => true,
       'edit_post' => true,
       'delete_post' => true,
       'view_blog' => true,
       'index_blog' => true,
       'new_blog' => true,
       'save_blog' => true,
       'edit_blog' => true,
       'delete_blog' => true,
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRouteNames[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        $escapedName = str_replace('.', '__', $name);

        list($variables, $defaults, $requirements, $tokens) = $this->{'get'.$escapedName.'RouteInfo'}();

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }

    private function get_welcomeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/',  ),));
    }

    private function get_demo_loginRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/secured/login',  ),));
    }

    private function get_security_checkRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/secured/login_check',  ),));
    }

    private function get_demo_logoutRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/secured/logout',  ),));
    }

    private function getacme_demo_secured_helloRouteInfo()
    {
        return array(array (), array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/secured/hello',  ),));
    }

    private function get_demo_secured_helloRouteInfo()
    {
        return array(array (  0 => 'name',), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'name',  ),  1 =>   array (    0 => 'text',    1 => '/demo/secured/hello',  ),));
    }

    private function get_demo_secured_hello_adminRouteInfo()
    {
        return array(array (  0 => 'name',), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'name',  ),  1 =>   array (    0 => 'text',    1 => '/demo/secured/hello/admin',  ),));
    }

    private function get_demoRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/',  ),));
    }

    private function get_demo_helloRouteInfo()
    {
        return array(array (  0 => 'name',), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'name',  ),  1 =>   array (    0 => 'text',    1 => '/demo/hello',  ),));
    }

    private function get_demo_contactRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/demo/contact',  ),));
    }

    private function get_wdtRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/_wdt',  ),));
    }

    private function get_profiler_searchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/search',  ),));
    }

    private function get_profiler_purgeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/purge',  ),));
    }

    private function get_profiler_importRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_profiler/import',  ),));
    }

    private function get_profiler_exportRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '.txt',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/\\.]+?',    3 => 'token',  ),  2 =>   array (    0 => 'text',    1 => '/_profiler/export',  ),));
    }

    private function get_profiler_search_resultsRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/search/results',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  2 =>   array (    0 => 'text',    1 => '/_profiler',  ),));
    }

    private function get_profilerRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/_profiler',  ),));
    }

    private function get_configurator_homeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_configurator/',  ),));
    }

    private function get_configurator_stepRouteInfo()
    {
        return array(array (  0 => 'index',), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'index',  ),  1 =>   array (    0 => 'text',    1 => '/_configurator/step',  ),));
    }

    private function get_configurator_finalRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/_configurator/final',  ),));
    }

    private function getblog_homeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\DefaultController::homeAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/blog',  ),));
    }

    private function getview_postRouteInfo()
    {
        return array(array (  0 => 'blog',  1 => 'post',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::postAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'post',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  2 =>   array (    0 => 'text',    1 => '/blog',  ),));
    }

    private function getblog_adminRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\DefaultController::admin_Action',), array (), array (  0 =>   array (    0 => 'text',    1 => '/blog_admin',  ),));
    }

    private function getblog_admin_blogRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\DefaultController::admin_blog_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/blog_admin',  ),));
    }

    private function getblog_admin_postRouteInfo()
    {
        return array(array (  0 => 'blog',  1 => 'post',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\DefaultController::admin_post_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'post',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  2 =>   array (    0 => 'text',    1 => '/blog_admin',  ),));
    }

    private function getnew_postRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::new_post_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/new_post',  ),));
    }

    private function getnuevo_postRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::new_post_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/nuevo_post',  ),));
    }

    private function getsave_postRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::new_post_Action',), array (), array (  0 =>   array (    0 => 'text',    1 => '/save_post',  ),));
    }

    private function getedit_postRouteInfo()
    {
        return array(array (  0 => 'blog',  1 => 'title',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::edit_post_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'title',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  2 =>   array (    0 => 'text',    1 => '/edit_post',  ),));
    }

    private function getdelete_postRouteInfo()
    {
        return array(array (  0 => 'post_id',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\PostController::delete_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'post_id',  ),  1 =>   array (    0 => 'text',    1 => '/edit_post',  ),));
    }

    private function getview_blogRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::index_blog_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/view_blog',  ),));
    }

    private function getindex_blogRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::indexAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/blog',  ),));
    }

    private function getnew_blogRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::new_blog_Action',), array (), array (  0 =>   array (    0 => 'text',    1 => '/new_blog',  ),));
    }

    private function getsave_blogRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::save_Action',), array (), array (  0 =>   array (    0 => 'text',    1 => '/save_blog',  ),));
    }

    private function getedit_blogRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::edit_blog_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/edit_blog',  ),));
    }

    private function getdelete_blogRouteInfo()
    {
        return array(array (  0 => 'blog',), array (  '_controller' => 'Acme\\BlogBundle\\Controller\\BlogController::delete_Action',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'blog',  ),  1 =>   array (    0 => 'text',    1 => '/delete_blog',  ),));
    }
}
