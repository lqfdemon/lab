<?php
namespace app\index\controller;
use think\Session;
use think\View;
use think\Db;
use think\Controller;
use think\Log;

use app\index\model\File;


class CommonController extends Controller
{  
	function _initialize() {
		if(!Session::has('id')){
			$this->redirect('index/SignIn/signIn');
            return;
        }
	}
	public function download_file($file_id){     
        $File = new File();
        $root = FILE_DOWNLOAD_ROOT_PATH;   
        if (false === $File -> download($root, $file_id)) {
            $this -> error($File -> getError());
        }   
    }
    public function upload_file($file_class){
        // 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file');
		if(empty($file)){
			Log::record("上传失败，未获取到上传的文件");
		}
		// 移动到框架应用根目录/public/uploads/ 目录下
		$catalog = "other/";
		switch ($file_class) {
			case '1':
				$catalog = "paper/";
				break;
			case '2':
				$catalog = "data/";
				break;
			default:
				$catalog = "other/";
				break;
		}
        $dir = FILE_PATH.$catalog;
        $info = $file->rule('uniqid')
                     ->move($dir);
		Log::record($info);
        if($info){
			$file_name = $info->getFilename();
			$url = FILE_FLODER.$catalog.$file_name;
            $data=[ 'name'=>$_POST['name'],
                    'url'=>$url,
                    'ext'=>$info->getExtension(),
                    'md5'=>$info->hash('md5'),
                    'sha1'=>$info->hash('sha1'),
                    'size'=>$_POST['size'],
					'create_time'=>time(),
					'class'=>$file_class,
            ];
            $file_modal = new File();
            $file_modal->save($data);
            return $file_modal->id;
        }else{
            // 上传失败获取错误信息
            Log::record($info->getError());
            return false;
        }
    }
}