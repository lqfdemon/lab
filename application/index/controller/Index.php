<?php
namespace app\index\controller;

use think\Controller;
use think\View;
use think\Db;
use think\Session;
use think\Log;

class Index extends CommonController
{
    public function index()
    {
        $this->assign('title',"后台管理");
        return $this->fetch();
    }
}
