<?php
require_once './vendor/autoload.php';

\TpQueue\Queue::instance()->do('doJob')->job(\tests\TestJob::class)->data([1, 2, 3])->push();
