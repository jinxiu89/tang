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
use app\backend\business\User as UserBusiness;
use app\backend\validate\User as UserValidate;use app\BaseController;use Exception;use think\App;use think\facade\Session;use think\facade\View;
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
            //添加操作
        }
    }
    /***
    * @param int $id
    * @return string
    */
    public function edit(int $id){
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
            if(!$this->validate->scene('email')->check($data)){//验证
                return jsonShow(0,$this->validate->getError());
            }
            try{
                $result=$this->business->login($data);
                if($result['status'] == 1){
                    Session::set('adminUser',$result['data']);
                    return jsonShow($result['status'],$result['message'],['next'=>$this->next]);
                }
                return jsonShow($result['status'],$result['message']);

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