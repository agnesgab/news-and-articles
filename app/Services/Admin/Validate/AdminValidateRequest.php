<?php

namespace App\Services\Admin\Validate;

class AdminValidateRequest
{
    private string $adminName;
    private string $adminPassword;

    public function __construct(string $adminName, string $adminPassword)
    {
        $this->adminName = $adminName;
        $this->adminPassword = $adminPassword;
    }

    public function getAdminName(): string
    {
        return $this->adminName;
    }

    public function getAdminPassword(): string
    {
        return $this->adminPassword;
    }
}