<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Атрибут',
    'defaultController' => 'news',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    // application components
    'components' => array(
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),

        'db' => require(dirname(__FILE__) . '/db.php'),

        'request' => array(
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true,
        ),

        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '/signIn' => '/site/signIn',
                '/signOut' => '/site/signOut',
                '/signUp' => '/site/signUp',
                '/about' => '/site/about',
                '/contacts' => '/site/contacts',
                '/delivery' => '/site/delivery',
                '/wholesale' => '/site/wholesale',
                '/actions' => '/action/index',
                '/cart' => '/order/cart',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<news:\w+>/<id:\d+>' => '<controller>/<news>',
                '<controller:\w+>/<news:\w+>' => '<controller>/<news>',
            ),
        ),


        'errorHandler' => array(
            // use 'site/error' news to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages

//                array(
//                    'class'=>'CWebLogRoute',
//                ),

            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
    'language' => 'ru'
,
);