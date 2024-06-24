<?php

namespace OSService\Traits;

use OSS\OssClient;

trait OssBucketNameTrait
{
    protected string $bucketName;
    public function setOssBucketName(string $bucketName): void
    {
        $this->bucketName = $bucketName;
    }
}

