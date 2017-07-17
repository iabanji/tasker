<?php 

namespace app\models;
use app\core\Application;

/**
 * Class TaskModel
 * @package app\models
 */
Class TaskModel
{
    /**
     * TaskModel constructor.
     */
    function __construct()
    {
        $this->app = Application::getInstance();
    }

    /**
     * @return array
     */
    public function createTask()
    {
        $errors = [];

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
        {
            $tempName = $_FILES['photo']['tmp_name'];

            $trueName = $_FILES['photo']['name'];
            $imageType = exif_imagetype($tempName);

            if($imageType == 1 || $imageType == 2 || $imageType == 3)
            {

                $image = new \Imagick($tempName);
                $image->adaptiveResizeImage(320,240);
                $isSaved = $image->writeImage($this->app->getParam('uploadPath') . '/' . $trueName);
                //base64_encode($image);exit;
                if($isSaved)
                {
                    $this->save(
                        $this->app->request->post('userName'),
                        $this->app->request->post('email'),
                        $this->app->request->post('description'),
                        $trueName
                    );
                }


            }else
            {
                $errors[] = 'Изображение должнл быть расширения (JPG/GIF/PNG)';
            }
        }else
        {
            $errors[] = 'Изображение должно быть выбрано';
        }

        return $errors;
    }

    /**
     * @param $userName
     * @param $email
     * @param $description
     * @param $fileName
     */
    protected function save($userName, $email, $description, $fileName)
    {
        $pdo = $this->app->db->PDO;
        try {
            $query = $pdo
                ->prepare(
                            "INSERT INTO 
                                task(email, description, user_name, img_path, status)
                                VALUES(:email, :description, :user_name, :img_path, :status)
                            "
                );
            $query->execute(array(
                "email" => $userName,
                "description" => $email,
                "user_name" => $description,
                "img_path" => $fileName,
                'status' => 0
            ));
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getCountTask()
    {
      return $this
          ->app
          ->db
          ->PDO
          ->query("SELECT COUNT(id) as count FROM task")
            ->fetch(\PDO::FETCH_OBJ)
          ->count;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTask($id)
    {
       $query = $this
            ->app
            ->db
            ->PDO
            ->prepare("SELECT id, description, `status` as stat
                      FROM task
                      WHERE task.id = :id
                    ");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();

       return $query->fetch();

    }

    /**
     * @param $id
     * @param $description
     * @param $status
     * @return bool
     */
    public function update($id, $description, $status)
    {
        $pdo = $this->app->db->PDO;
        try {
            $query = $pdo
                ->prepare(
                    "UPDATE `task` 
                            SET description = :description,
                             status =:status
                            WHERE task.id = :id
                    "
                );

            $query->execute(array(
                "id" => $id,
                "description" => $description,
                "status" => $status
            ));
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return true;
    }
}