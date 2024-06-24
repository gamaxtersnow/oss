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
            ->setArgument('accessKeyId',$this->config->get('access_key'))
            ->setArgument('accessKeySecret',$this->config->get('access_secret'))
            ->setArgument('endpoint',$this->config->get('end_point'))
            ->setArgument('isCName',$this->config->get('is_cname'))
            ->setArgument('securityToken',$this->config->get('security_token'))
            ->setArgument('requestProxy',$this->config->get('request_proxy'));
    }
    private function _registerOss(): void
    {
        $this->register('oss', OssService::class)
            ->addMethodCall('setOssClient', [new Reference('ossClient')])
            ->addMethodCall('setOssBucket', $this->config->get('bucket_name'));
    }
}