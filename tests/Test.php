<?php
require_once './vendor/autoload.php';
//立即执行
\TpQueue\Queue::instance()->do('doJob')->job(\tests\TestJob::class)->data([1, 2, 3])->push();

//延迟5秒执行
\TpQueue\Queue::instance()->do('doJob1')->job(\tests\TestJob::class)->data([1, 2, 3],123)->secs(5)->push();

//如果出现错误 最大错误4次
\TpQueue\Queue::instance()->do('doJob1')->job(\tests\TestJob::class)->data([1, 2, 3],123)->errorCount(4)->push();
