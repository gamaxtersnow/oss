<?php
namespace OSService;

use OSService\Contact\OssClientInterface;
use OSService\Traits\OssClientTrait;
use OSS\Core\OssException;
use OSS\Http\RequestCore_Exception;
use think\facade\Log;

/**
 * OSS服务类
 */
class OssService implements OssClientInterface {
    use OssClientTrait;
    /**
     *  上传附件到阿里oss
     *
     * @param string $bucket
     * @param string $fileName
     * @param string $url
     * @return string
     */
    public function uploadMedia(string $bucket,string $fileName,string $url): string
    {
        try {
            $res = $this->ossClient->uploadFile($bucket, $fileName, $url);
            return $res['info']['url']??'';
        }catch (OssException|RequestCore_Exception $e){
            Log::error($e->getMessage());
            return '';
        }
    }


    public function uploadStream(string $bucket, string $object, $handle, array $options = NULL): string|null
    {
        try {
            $res = $this->ossClient->uploadStream($bucket, $object, $handle,$options);
            return $res['info']['url']??'';
        } catch (OssException|RequestCore_Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}