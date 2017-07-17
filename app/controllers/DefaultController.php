<?php 

namespace app\controllers;

use app\core\Application;
use app\core\BaseController;
use app\models\Pagination;
use app\models\TaskModel;

class DefaultController extends BaseController
{
    /**
     * DefaultController constructor.
     */
	public function __construct()
	{
	    $this->app = Application::getInstance();
	}

    /**
     * Make action index
     */
	public function index()
	{
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

	}

    /**
     * Make crate action
     */
	public function create()
	{
        $errors = (new TaskModel())->createTask();

        $this->render('create',['errors' => $errors]);
	}

    /**
     * Ajax action for preview
     * @view base64
     */
    public function preview()
    {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
        {
            $tempName = $_FILES['photo']['tmp_name'];
            $trueName = $_FILES['photo']['name'];
            $imageType = exif_imagetype($tempName);

            if ($imageType == 1 || $imageType == 2 || $imageType == 3) {
                $image = new \Imagick($tempName);
                $image->adaptiveResizeImage(320, 240);

                echo base64_encode($image);exit;
            }
        }
    }
}