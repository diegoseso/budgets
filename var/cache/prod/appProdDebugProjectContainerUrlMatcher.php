<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdDebugProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // create
        if ($pathinfo === '/new-product') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::newAction',  '_route' => 'create',);
        }

        // get
        if (0 === strpos($pathinfo, '/get-product') && preg_match('#^/get\\-product/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'get')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::getAction',));
        }

        // alter
        if ($pathinfo === '/alter-product') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_alter;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::alterProductAction',  '_route' => 'alter',);
        }
        not_alter:

        // delete
        if ($pathinfo === '/delete-product') {
            if ($this->context->getMethod() != 'DELETE') {
                $allow[] = 'DELETE';
                goto not_delete;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::deleteAction',  '_route' => 'delete',);
        }
        not_delete:

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/api/budgets')) {
            // api_budgets_get_budgets
            if (preg_match('#^/api/budgets(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_budgets_get_budgets;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_budgets_get_budgets')), array (  '_controller' => 'AppBundle\\Controller\\BudgetsController::getBudgetsAction',  '_format' => NULL,));
            }
            not_api_budgets_get_budgets:

            // api_budgets_post_budgets
            if (preg_match('#^/api/budgets(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_budgets_post_budgets;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_budgets_post_budgets')), array (  '_controller' => 'AppBundle\\Controller\\BudgetsController::postBudgetsAction',  '_format' => NULL,));
            }
            not_api_budgets_post_budgets:

            // api_budgets_put_budgets
            if (preg_match('#^/api/budgets(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_api_budgets_put_budgets;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_budgets_put_budgets')), array (  '_controller' => 'AppBundle\\Controller\\BudgetsController::putBudgetsAction',  '_format' => NULL,));
            }
            not_api_budgets_put_budgets:

            // api_budgets_delete_budgets
            if (preg_match('#^/api/budgets(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_api_budgets_delete_budgets;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_budgets_delete_budgets')), array (  '_controller' => 'AppBundle\\Controller\\BudgetsController::deleteBudgetsAction',  '_format' => NULL,));
            }
            not_api_budgets_delete_budgets:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
