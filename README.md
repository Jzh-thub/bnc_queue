# think-queue for ThinkPHP6

# 原始文档:https://github.com/top-think/think-queue

## 安装

> composer require blue-nest-cloud/bnc-queue

## 配置

> 配置文件位于 `config/queue.php`

### 使用方式

> 立即执行--> Queue::instance()->do('方法名')->job('任务执行类名')->data('执行数据')->push();

> 延时执行--> Queue::instance()->do('方法名')->job('任务执行类名')->data('执行数据')->secs('秒')->push();

> 任务执行类 必须继承 BaseJob

> 更多用法见 源码 

## 监听任务并执行

> php think queue:listen

> php think queue:work

两种，具体的可选参数可以输入命令加 --help 查看

>可配合supervisor使用，保证进程常驻

>supervisor使用方式:宝塔安装Supervisor,添加守护进程,启动用户www,运行目录:项目根目录,启动命令:php think queue:listen --queue,进程数量:1

### 下面写两个例子

```
class Index{

    public function index(Request $request)
    {
        Queue::instance()->do(index)->job(TestJob::class)->data([1, 2, 3])->push();
        Queue::instance()->do(job)->job(TestJob::class)->data([1, 2, 3],123)->secs(5)->push();
    }
}

clss TestJob extend  BaseJob{
    
    public function index($data){
        print_r($data);
        
        //返回true表示消费完成
        return true;
        //返回false表示消费失败 如果未设置失败次数 默认3次失败后 就删除任务
        return false;
    }
    
    public function job($data,$data1){
        //5秒后才会执行
        print_r($data); //[1,2,3]
        print_r($data1);//123
    }
}
