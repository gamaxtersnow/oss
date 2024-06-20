<?php
 namespace OSService\Think;

 use OSService\App;
 use think\Service;
class OSService extends Service
{
    public function register(): void
    {
        $config = config('oss');
        if(empty($config)) {
            $config = require __DIR__.'/oss.php';
        }
        $this->app->bind('oss', new App($config));
    }

    public function boot()
    {
        // 服务启动
    }
}

