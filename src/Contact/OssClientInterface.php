<?php
namespace OSService\Contact;
/**
 * OSS接口类
 */
interface OssClientInterface{
    /**
     * 上传URL附件到阿里oss
     * @param string $bucket
     * @param string $fileName
     * @param string $url
     * @return string
     */
    public function uploadMedia(string $bucket,string $fileName,string $url):string;

    /**
     *  上传stream附件到阿里oss
     * @param string $bucket
     * @param string $object
     * @param $handle
     * @param array|null $options
     * @return string|null
     */
    public function uploadStream(string $bucket, string $object,$handle, array $options = NULL): string|null;

    /**
     * 获取object 签名url
     * @param string $bucket
     * @param string $object
     * @param int $expiration
     * @return string
     */
    public function getObjectSignUrl(string $bucket,string $object,int $expiration):string;
}