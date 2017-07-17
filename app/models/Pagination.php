<?php

namespace app\models;
use app\core\Application;

class Pagination
{
    /**
     * @var mixed
     */
    public $countPages;

    /**
     * @var int
     */
    public $perPage = 3;

    /**
     * @var int
     */
    public $curPage = 1;

    /**
     * @var int
     */
    public $limit;

    /**
     * @var float
     */
    public $range;

    /**
     * @var array
     */
    public $sortParam =
        [
            'user_name',
            'email',
            'stat'
        ];

    /**
     * @var TaskModel
     */
    protected $_task;

    /**
     * Pagination constructor.
     * @param TaskModel $task
     * @param $curPage
     * @param $perPage
     * @param $sort
     */
    public function __construct(TaskModel $task, $curPage, $perPage, $sort)
    {
        $this->app = Application::getInstance();
        $this->curPage = $curPage;
        $this->perPage = $perPage;
        $this->_task = $task;
        $this->countPages = $this->_task->getCountTask();
        $this->range  = ceil($this->countPages / $this->perPage);
        $this->limit = $this->perPage * ($this->curPage - 1);

        if(in_array($sort, $this->sortParam)){
            $this->sort = $sort;
        }else{
            $this->sort = 'user_name';
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        $pdo = $this->app->db->PDO;

        $query = $pdo->prepare("SELECT id, email, description, `status` as stat, user_name, img_path
                                 FROM task 
                                 ORDER BY {$this->sort} DESC 
                                 LIMIT :limit, :perPage");

        $query->bindParam(':perPage', $this->perPage, \PDO::PARAM_INT);
        $query->bindParam(':limit', $this->limit, \PDO::PARAM_INT);
        //$query->bindParam(':sort', $this->sort, \PDO::PARAM_INT); Подводный камень
        $query->execute();

        return $query->fetchAll();
    }


}