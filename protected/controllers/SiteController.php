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

    public function actionFeedback()
    {
        $email = (isset($_POST['email'])) ? $_POST['email'] : 'Не указана';
        $name = (isset($_POST['name'])) ? $_POST['name'] : 'Не указано';

        $message = 'Имя: '.$name.'<br>';
        $message .= 'Email: '.$email.'<br><br>';
        $message .= (isset($_POST['message'])) ? $_POST['message'] : '';

        $to = 'info@attribute.pro';
        $subject = 'Вопрос';

        $headers = "from: <" . $to . "> \n";
        $headers .= "content-type: text/html; charset=utf-8 \n";
        $headers .= "mime-version: 1.0 \n";

        mail($to, $subject, $message, $headers);

        Yii::app()->user->setFlash('questionSent',true);
        $this->redirect('/');
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
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
        }

        $this->pageTitle = 'Регистрация';

        $model = new User();

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password = User::hashPassword($model->password);
            if ($model->save()) {

                $message = 'Для активации Вашего профиля перейдите по ссылке: http://attribute.pro/user/activate?c=' . md5($model->email);

                $mailer = new Mailer();
                $mailer->sendMailSimple($model, 'Регистрация на сайте Attribute.pro', $message);

                Yii::app()->user->setFlash('signUp', true);
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
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
        }

        $this->pageTitle = 'Вход';

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