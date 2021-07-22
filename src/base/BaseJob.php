<?php

namespace bnc\queue\base;

use think\facade\Log;
use think\queue\Job;

class BaseJob implements JobInterface
{
    public function __call($name, $arguments)
    {
        $this->fire(...$arguments);
    }

    public function fire(Job $job, $data): void
    {
        try {
            $action     = $data['do'] ?? 'doJob';  // 任务名
            $infoData   = $data['data'] ?? [];     //执行数据
            $errorCount = $data['errorCount'] ?? 0;//最大错误次数
            $log        = $data['log'] ?? null;
            if (method_exists($this, $action)) {
                $res = $this->{$action}(...$infoData);
                if ($res === true) {
                    //删除任务
                    $job->delete();
                    //记录日志
                    $this->info($log);
                } else {
                    if ($job->attempts() >= $errorCount && $errorCount) {
                        //删除任务
                        $job->delete();
                        //记录日志
                        $this->info($log);
                    } else {
                        //从新放入队列
                        if (is_numeric($res))
                            $job->release($res);
                        else $job->release();

                    }
                }
            } else {
                $job->delete();
            }
        } catch (\Throwable $exception) {
            $job->delete();
            Log::error('执行消息队列发生错误,错误原因:' . $exception->getMessage());
        }
    }

    /**
     * 打印成功提示
     * @param $log
     */
    protected function info($log)
    {
        try {
            if (is_callable($log)) {
                print_r($log() . "\r\n");
            } elseif (is_string($log) || is_array($log)) {
                print_r($log . "\r\n");
            }
        } catch (\Throwable $exception) {
            print_r($exception->getMessage());
        }
    }

    /**
     * 任务失败执行方法
     * @param $data
     * @param $e
     */
    public function failed($data, $e)
    {

    }
}