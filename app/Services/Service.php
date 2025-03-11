<?php

namespace App\Services;

class Service
{
    protected string $locale;

    public const STATUS_SUCCESS = 1;
    public const STATUS_FAIL = 0;

    protected function finalResultSuccess($data = []): array
    {
        return ['status' => self::STATUS_SUCCESS, 'data' => $data, 'message' => 'success'];
    }

    protected function finalResultFail($dataFail = [], string $message = ""): array
    {
        return ['status' => self::STATUS_FAIL, 'data' => $dataFail, 'message' => $message];
    }
}
