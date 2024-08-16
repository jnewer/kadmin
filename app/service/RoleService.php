<?php

namespace app\service;

use app\model\Role;
use app\service\BaseService;
use app\model\RolePermission;
use app\validator\RoleValidator;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method Role findModel(int $id)
 */
class RoleService extends BaseService
{
    protected string $model = Role::class;

    protected string $validator = RoleValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query = Role::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        
        if (!empty($filters['created_at_start'])) {
            $query->where('created_at', '>=', $filters['created_at_start']);
        }

        if (!empty($filters['created_at_end'])) {
            $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59');
        }

        return $query;
    }

    /**
     * 获取子角色
     *
     * @param Role $role
     * @return array
     */
    public function getChildren(Role $role): array
    {
        $data = [];
        foreach ($role->children as $child) {
            $childArr = $child->toArray();
            $childArr['children'] = $this->getChildren($child);
            $data[] = $childArr;
        }

        return $data;
    }

    /**
     * 获取顶级角色
     *
     * @return Collection|Role[]
     */
    public function getTopRoles()
    {
        return Role::where('pid', 0)->get();
    }

    /**
     * @return array
     */
    public function tree(): array
    {
        $roles = $this->getTopRoles();
        $tree = [];
        foreach ($roles as $role) {
            $roleArr = $role->toArray();
            $roleArr['children'] = $this->getChildren($role);
            $tree[] = $roleArr;
        }

        return $tree;
    }

    /**
     * @param array $roleIds
     * @return array
     */
    public static function getPermissionIds(array $roleIds): array
    {
        return RolePermission::whereIn('role_id', $roleIds)->get()->pluck('permission_id')->toArray();
    }

    public function assignAuth(int $roleId, array $permissionIds): bool
    {
        $role = $this->findModel($roleId);

        $role->permissions()->sync($permissionIds);

        return true;
    }
}
