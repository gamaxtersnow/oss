<?php

namespace OSService\Traits;

use OSS\OssClient;

trait OssClientTrait
{
    protected OssClient $ossClient;
    public function setOssClient(OssClient $ossClient): void
    {
        $this->ossClient = $ossClient;
    }
}
