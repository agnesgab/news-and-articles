<?php

namespace App\Services\Admin\Validate;

use App\Repositories\Admin\AdminRepository;

class AdminValidateService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function execute(AdminValidateRequest $request): bool
    {
        $adminQuery = $this->adminRepository->validate($request->getAdminName());

        if ($adminQuery !== null && password_verify($request->getAdminPassword(), $adminQuery['password'])) {
            return true;
        }

        return false;
    }
}