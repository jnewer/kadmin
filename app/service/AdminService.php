<?php

namespace app\service;

use app\model\Admin;
use app\model\AdminRole;
use app\service\BaseService;
use app\validator\AdminValidator;
use Illuminate\Database\Eloquent\Builder;

class AdminService extends BaseService
{
    protected string $model = Admin::class;

    protected string $validator = AdminValidator::class;

    public function builder(array $filters = []): Builder
    {
        $query = Admin::query();

        if (!empty($filters['username'])) {
            $query->where('username', 'like', '%' . $filters['username'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['created_at_start'])) {
            $query->where('created_at', '>=', $filters['created_at_start']);
        }

        if (!empty($filters['created_at_end'])) {
            $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59');
        }

        return $query;
    }

    public static function findByUsername(string $username): Admin|null
    {
        return Admin::where('username', $username)->where('status', Admin::STATUS_ACTIVE)->first();
    }

    public function getRoleIds(int $adminId): array
    {
        return AdminRole::where('admin_id', $adminId)->get()->pluck('role_id')->toArray();
    }

    public function profile(int $id): array
    {
        $admin = $this->findModel($id);
        $roleIds = $this->getRoleIds($id);
        $permissionIds = RoleService::getPermissionIds($roleIds);
        $permissions = PermissionService::getCodes($permissionIds);

        $data = $admin->toArray();
        $data['permissions'] = $permissions;

        return $data;
    }

    public function changePassword(int $id, array $data): bool
    {
        $data = AdminValidator::instance()->validated($data, 'changePassword');

        $admin = $this->findModel($id);
        $admin->password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        return $admin->save();
    }

    public function create(array $data): mixed
    {
        $data = $this->validator::instance()->validated($data, 'create');
        $admin = Admin::create($data);

        $admin->roles()->sync($data['role_ids']);

        return $admin;
    }

    public function update(int $id, $data): bool
    {
        $data = $this->validator::instance()->setModelId($id)->validated($data, 'update');
        $admin = $this->findModel($id);

        $admin->update($data);

        $admin->roles()->sync($data['role_ids']);

        return true;
    }
}
