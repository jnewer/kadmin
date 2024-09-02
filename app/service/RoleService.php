<?php

namespace app\service;

use app\model\Role;
use app\service\BaseService;
use app\model\RoleMenu;
use app\validator\RoleValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Role findModel(int $id)
 */
class RoleService extends BaseService
{
    protected string $model = Role::class;

    protected string $validator = RoleValidator::class;

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

    public function getTopRoles(): Collection
    {
        return Role::where('pid', 0)->get();
    }

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

    public function assignMenu(int $roleId, array $menuIds): bool
    {
        $role = $this->findModel($roleId);

        $role->menus()->sync($menuIds);

        return true;
    }

    public static function getMenuIds(array $roleIds): array
    {
        return RoleMenu::whereIn('role_id', $roleIds)->get()->pluck('menu_id')->toArray();
    }
}
