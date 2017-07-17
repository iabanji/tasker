<?php

namespace app\controllers;

use app\core\Application;
use app\core\BaseController;
use app\models\Pagination;
use app\models\TaskModel;

/**
 * Class AdminController
 * @package app\controllers
 */
class AdminController extends BaseController
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->layout = 'admin';
        $this->app = Application::getInstance();

    }

    public function index()
    {
        if($_SESSION['isLoggedIn'] != true)
        {
            $this->redirect('/admin/login');
        }

        $curPage = ($this->app->request->get('curPage'))
            ? $this->app->request->get('curPage')
            : 1;
        $sort = ($this->app->request->get('sort'))
            ? $this->app->request->get('sort')
            : 'user_name';

        $pagination = new Pagination(new TaskModel(), $curPage, 3, $sort);

        $data = $pagination->getData();
        //var_dump($data);exit;
        $this->render('index',
            [
                'tasks' => $data,
                'pagination' => $pagination
            ]
        );
        $this->render('index',
            [
                'name' => 'vasya'
            ]
        );

    }
    
    public function login()
    {
        $login = $this->app->request->post('login');
        $password = $this->app->request->post('password');

        if($login == 'admin' && $password == '123')
        {
            $_SESSION['isLoggedIn'] = true;
            $this->redirect('/admin/index');
        }elseif ($_SESSION['isLoggedIn'] == true){
            $this->redirect('/admin/index');
        }

       $this->render('login');
    }

    public function edit()
    {
        $id = $this->app->request->get('id');

        $task = new TaskModel();

        $task = $task->getTask($id);

        if(!$task)
        {
            $this->redirect('/admin/index');
        }

        $this->render('edit',
            [
                'task' => $task
            ]
        );
    }

    public function update()
    {
        $id = $this->app->request->get('id');
        $status = $this->app->request->post('status');
        $description = $this->app->request->post('description');

        $task = new TaskModel();

        $result = $task->update($id, $description, $status);

        if($result)
        {
            $this->redirect('/admin/edit?id=' . $id);
        }
    }
}