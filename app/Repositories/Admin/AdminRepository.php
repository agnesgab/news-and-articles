<?php

namespace App\Repositories\Admin;

interface AdminRepository {

    public function validate(string $adminName);
}