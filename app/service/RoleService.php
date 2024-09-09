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
        return Role::query()
            ->when(!empty($filters['name']), fn($query) => $query->where('name', 'like', '%' . $filters['name'] . '%'))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }

    public function getChildren(Role $role): array
    {
        return collect($role->children)->map(function ($child) {
            $childArr = $child->toArray();
            $childArr['children'] = $this->getChildren($child);
            return $childArr;
        })->toArray();
    }

    public function getTopRoles(): Collection
    {
        return Role::where('pid', 0)->get();
    }

    public function tree(): array
    {
        return $this->getTopRoles()->map(function ($role) {
            $roleArr = $role->toArray();
            $roleArr['children'] = $this->getChildren($role);
            return $roleArr;
        })->toArray();
    }

    public function assignMenu(int $roleId, array $menuIds): bool
    {
        $role = $this->findModel($roleId);
        $role->menus()->sync($menuIds);
        return true;
    }

    public static function getMenuIds(array $roleIds): array
    {
        return RoleMenu::whereIn('role_id', $roleIds)->pluck('menu_id')->toArray();
    }
}
