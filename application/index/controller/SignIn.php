<?php
namespace app\index\controller;
use think\Session;
use think\View;
use think\Db;
use think\Controller;
use think\Log;

use app\index\model\User;

class SignIn extends Controller
{  
    public function signIn(){
        $this->assign('title',"登录");
        return $this->fetch();
    }

    public function check(){
        $user = User::where('account',$_POST['account'])->find();
        if($user){
            if(md5($_POST['password']) == $user['password']){
                session('id',$user['id']);
                session('name',$user['name']);
                $this->success("正确");
            }else{
                $this->error("密码错误");
            }
        }else{
            $this->error("用户不存在");
        }
    }
}