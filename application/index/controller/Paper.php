<?php
namespace app\index\controller;

use think\Controller;
use think\View;
use think\Db;
use think\Session;
use think\Log;

class Paper extends CommonController
{
    public function manage(){
        $this->assign('title','文章');
        return $this->fetch();
    }
    public function upload(){
        $this->assign('title','文章上传');
        return $this->fetch();
    }
}