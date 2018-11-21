<?php
namespace app\index\controller;

use think\Controller;
use think\View;
use think\Db;
use think\Session;
use think\Log;

class Home extends Controller
{
    public function index()
    {
        $this->assign('title',"主页");
        return $this->fetch();
    }
    public function paper()
    {
        $this->assign('title',"论文");
        return $this->fetch();
    }
    public function data()
    {
        $this->assign('title',"数据");
        return $this->fetch();
    }
    public function code()
    {
        $this->assign('title',"算法");
        return $this->fetch();
    }
    public function group()
    {
        $this->assign('title',"团队");
        return $this->fetch();
    }
    public function contact()
    {
        $this->assign('title',"联系我们");
        return $this->fetch();
    }
}
