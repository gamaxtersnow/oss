<?php
namespace OSService;
use Doctrine\Common\Collections\ArrayCollection;
use OSS\OssClient;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class App extends ContainerBuilder{
    private ArrayCollection $config;
    public function __construct(array $config)
    {
        parent::__construct();

        $this->config = new ArrayCollection($config);
        $this->_registerOssClient();
        $this->_registerOss();

    }
    private function _registerOssClient(): void
    {
        $this->register('ossClient', OssClient::class)
            ->setArguments([$this->config->get('access_key'),$this->config->get('access_secret'),$this->config->get('end_point')]);
    }
    private function _registerOss(): void
    {
        $this->register('oss', OssService::class)
            ->addMethodCall('setOssClient', [new Reference('ossClient')]);
    }
}