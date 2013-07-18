<?php

class SiteController extends FrontController
{
    public function actionAbout()
    {
        $this->pageTitle = 'О нас';
        /** @var $page Page */
        $page = Page::model()->findByPk(1);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    public function actionContacts()
    {
        $this->pageTitle = 'Контакты';
        /** @var $page Page */
        $page = Page::model()->findByPk(2);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    public function actionDelivery()
    {
        $this->pageTitle = 'Оплата и доставка';
        /** @var $page Page */
        $page = Page::model()->findByPk(3);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    public function actionActions()
    {
        $this->pageTitle = 'Акции';
        /** @var $page Page */
        $page = Page::model()->findByPk(5);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    public function actionWholesale()
    {
        $this->pageTitle = 'Оптовые продажи';
        /** @var $page Page */
        $page = Page::model()->findByPk(4);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }
//
//    /**
//     * This is the default 'index' action that is invoked
//     * when an action is not explicitly requested by users.
//     */
//    public function actionIndex()
//    {
//        $dataProvider = new CActiveDataProvider('News');
//        $this->render('/news/index', array(
//            'dataProvider' => $dataProvider,
//        ));
//    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionSignUp()
    {
        /** @var $model User */
        $model = new User();

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password = User::hashPassword($model->password);
            if ($model->save()) {
                $userIdentity = new UserIdentity($model->email, $_POST['User']['password']);
                if ($userIdentity->authenticate()) {
                    Yii::app()->user->login($userIdentity);
                }
                $this->redirect('/');
            }
        }
        $this->render('signUp', array('user' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionSignIn()
    {
        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('signIn', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionSignOut()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}