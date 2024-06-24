<?php
namespace OSService;

use OSService\Contact\OssClientInterface;
use OSService\Traits\OssBucketNameTrait;
use OSService\Traits\OssClientTrait;
use OSS\Core\OssException;
use OSS\Http\RequestCore_Exception;
use think\facade\Log;

/**
 * OSS服务类
 */
class OssService implements OssClientInterface {
    use OssClientTrait,OssBucketNameTrait;
    /**
     *  上传附件到阿里oss
     *
     * @param string $fileName
     * @param string $url
     * @return string
     */
    public function uploadMedia(string $fileName,string $url): string
    {
        try {
            $res = $this->ossClient->uploadFile($this->bucketName, $fileName, $url);
            return $res['info']['url']??'';
        }catch (OssException|RequestCore_Exception $e){
            Log::error($e->getMessage());
            return '';
        }
    }


    public function uploadStream(string $object, $handle, array $options = NULL): string|null
    {
        try {
            $res = $this->ossClient->uploadStream($this->bucketName, $object, $handle,$options);
            return $res['info']['url']??'';
        } catch (OssException|RequestCore_Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function getObjectSignUrl(string $object,int $expiration=3600): string
    {
        try {
           return $this->ossClient->signUrl($this->bucketName, $object, $expiration);
        }catch (OssException $e){
            Log::error($e->getMessage());
            return '';
        }
    }
}