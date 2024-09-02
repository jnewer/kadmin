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

    public function builder(array $filters = []): Builder
    {
        $query   = Permission::query();

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

    public function getChildren(Permission $permission, array $filters = []): array
    {
        $data = [];
        if (!empty($filters['type'])) {
            $query = $permission->children();
            if (is_array($filters['type'])) {
                $query->whereIn('type', $filters['type']);
            } else {
                $query->where('type', $filters['type']);
            }

            $children = $query->get();
        } else {
            $children = $permission->children;
        }
        
        foreach ($children as $child) {
            $childArr = $child->toArray();
            $childArr['children'] = $this->getChildren($child);
            $data[] = $childArr;
        }

        return $data;
    }

    public function getTopPermissions():Collection
    {
        return Permission::where('pid', 0)->get();
    }

    public function tree(array $filters = []): array
    {
        $permissions = $this->getTopPermissions();
        $tree = [];
        foreach ($permissions as $permission) {
            $permissionArr = $permission->toArray();
            $permissionArr['children'] = $this->getChildren($permission, $filters);
            $tree[] = $permissionArr;
        }

        return $tree;
    }

    public static function getCodes(array $ids): array
    {
        $hrefs = Permission::whereIn('id', $ids)->pluck('href')->toArray();

        return array_map(function ($href) {
            return str_replace('/', '.', ltrim($href, '/'));
        }, $hrefs);
    }
}
