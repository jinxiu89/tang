<?php
/***
 * File Name :User.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午4:46
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);
namespace app\backend\controller;
use app\backend\business\User as UserBusiness;use app\backend\validate\User as UserValidate;use app\BaseController;use Exception;use think\App;use think\facade\Session;use think\facade\View;
class User extends BaseController
{
    protected $validate;
    protected $business;
    protected $next;
    public function __construct(App $app) {
        parent::__construct($app);
        $this->validate=new UserValidate();
        $this->business=new UserBusiness();
    }

    public function index(){
        if($this->request->isGet()){
            try{
                $data=$this->business->GetDataByStatus();
                return View::fetch('',[
                'data'=>$data,]);
            }catch (Exception $exception){
                return jsonShow(0,$exception->getMessage(),[],500);
            }
        }
    }
    public function add(){
        if($this->request->isGet()){
            return View::fetch();
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('add')->check($data)){
                return jsonShow(0,$this->validate->getError());
            }
            try{
                $arr=explode('.',uniqid('',true));
                $data['uuid']=$arr[0]; // 生成Uuid
                $data['salt']=$arr[1]; //生成随机的加盐码
                $data['password']=md5($data['password'].$data['salt']); //把密码加盐后加密
                $data['action_user']=Session::get('adminUser')['username'];
                $result=$this->business->add($data);
                if($result){
                    return jsonShow(1,"新增成功");
                }
            }catch (Exception $exception){
                return jsonShow(0,'服务器内部错误');
            }
        }
    }
    /***
    * @return string
    */
    public function edit(){
        if($this->request->isGet()){
            $user_id=$this->request->param('id','',['int','trim','htmlentities']);
            if(!$this->validate->scene('id')->check(['id'=>$user_id])){
                dump($this->validate->getError());
            }
            try{
                $result=$this->business->getData((int) $user_id);
                return View::fetch('',['data'=>$result]);
            }catch (Exception $exception){
                dump($exception->getMessage());
            }
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('edit')->check($data)){
                return jsonShow(0,$this->validate->getError());
            }
            try{
                $result=$this->business->update((array) $data);
                if($result){
                    return jsonShow(1,'更新成功');
                }
                return jsonShow(0,'更新失败');
            }catch (Exception $exception){
                return jsonShow(0,$exception->getMessage());
            }
        }
    }

    /***
    * login
    * 登录方法，采用多层架构编写
    * @return string|\think\response\Json
    * @throws Exception
    */
    public function login(){
        $this->next=$this->request->param('next') ?? (string) url('index');
        if($this->request->isGet()){
            //如果已经登录就需要跳转到他来的那一页去，默认是后台首页
            if(Session::get('adminUser')){
                return redirect((string) $this->next);
            }
            return View::fetch();
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('name')->check($data)){//验证
                return jsonShow(0,$this->validate->getError());
            }
            try{
                $result=$this->business->login($data);
                if($result){
                    return jsonShow(1,'登录成功！',['next'=>$this->next]);
                }
                return jsonShow(0,'登录失败未知原因');
            }catch (Exception $exception){
                return jsonShow(0,$exception->getMessage());
            }
        }
    }

    public function logout(){

    }
    public function reg(){
        if($this->request->isGet()){
            return View::fetch();
        }
        if($this->request->isPost()){
            //todo::注册操作
        }
    }
    public function reset(){
        if($this->request->isGet()){
            return View::fetch();
        }
        if($this->request->isPost()){
            //todo：：找回密码更新操作
        }
    }
}