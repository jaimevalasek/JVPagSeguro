<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
        	'ps' => array(
        		'type' => 'Literal',
        		'options' => array(
        			'route'    => '/ps',
        			'defaults' => array(
        				'__NAMESPACE__' => 'JVPagSeguro\Controller',
        				'controller'    => 'Index',
        				'action'        => 'index',
        			),
        		),
        	),
        	'ps-pagar' => array(
        		'type' => 'Literal',
        		'options' => array(
        			'route'    => '/ps/pagar',
        			'defaults' => array(
        				'__NAMESPACE__' => 'JVPagSeguro\Controller',
        				'controller'    => 'Index',
        				'action'        => 'pagar',
        			),
        		),
        	),
        	'exemplo-retorno' => array(
        		'type' => 'Literal',
        		'options' => array(
        			'route'    => '/ps/exemplo-retorno',
        			'defaults' => array(
        				'__NAMESPACE__' => 'JVPagSeguro\Controller',
        				'controller'    => 'Index',
        				'action'        => 'exemplo-retorno',
        			),
        		),
        	),
        	'retorno' => array(
        		'type' => 'Literal',
        		'options' => array(
        			'route'    => '/ps/retorno',
        			'defaults' => array(
        				'__NAMESPACE__' => 'JVPagSeguro\Controller',
        				'controller'    => 'Index',
        				'action'        => 'retorno',
        			),
        		),
        	),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'JVPagSeguro\Controller\Index' => 'JVPagSeguro\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/ps.phtml',
            'jvpagseguro/index/index' => __DIR__ . '/../view/jvpagseguro/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
