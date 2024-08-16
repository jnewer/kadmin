<?php

namespace app\service;

use app\model\Permission;
use app\service\BaseService;
use app\validator\PermissionValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Permission findModel(int $id)
 */
class PermissionService extends BaseService
{
    protected string $model = Permission::class;

    protected string $validator = PermissionValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query   = Permission::query();

        if (!empty($filters['created_at_start'])) {
            $query->where('created_at', '>=', $filters['created_at_start']);
        }

        if (!empty($filters['created_at_end'])) {
            $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59');
        }

        return $query;
    }

    /**
     * 获取子权限
     *
     * @param Permission $permission
     * @return array
     */
    public function getChildren(Permission $permission): array
    {
        $data = [];
        foreach ($permission->children as $child) {
            $childArr = $child->toArray();
            $childArr['children'] = $this->getChildren($child);
            $data[] = $childArr;
        }

        return $data;
    }

    /**
     * 获取顶级权限
     *
     * @return Collection|Permission[]
     */
    public function getTopPermissions()
    {
        return Permission::where('pid', 0)->get();
    }

    /**
     * @return array
     */
    public function tree(): array
    {
        $permissions = $this->getTopPermissions();
        $tree = [];
        foreach ($permissions as $permission) {
            $permissionArr = $permission->toArray();
            $permissionArr['children'] = $this->getChildren($permission);
            $tree[] = $permissionArr;
        }

        return $tree;
    }

    /**
     * 获取权限标识
     *
     * @param array $ids
     * @return array
     */
    public static function getCodes(array $ids): array
    {
        $hrefs = Permission::whereIn('id', $ids)->pluck('href')->toArray();

        return array_map(function ($href) {
            return str_replace('/', '.', $href);
        }, $hrefs);
    }
}
