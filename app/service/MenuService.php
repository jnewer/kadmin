<?php

namespace app\service;

use app\model\Menu;
use app\service\BaseService;
use app\validator\MenuValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class MenuService extends BaseService
{
    protected string $model = Menu::class;

    protected string $validator = MenuValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query = Menu::query();

        if (!empty($filters['ids'])) {
            $query->whereIn('id', Arr::wrap($filters['ids']));
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


    public function getChildren(Menu $menu, array $filters = []): array
    {
        $data = [];
        if (!empty($filters['menuIds'])) {
            $children = $menu->children()->whereIn('id', Arr::wrap($filters['ids']))->get();
        } else {
            $children = $menu->children;
        }

        foreach ($children as $child) {
            $childArr = $child->toArray();
            $childArr['children'] = $this->getChildren($child);
            $data[] = $childArr;
        }

        return $data;
    }

    public function getTopMenus(array $filters = []): Collection
    {
        return $this->builder($filters)->where('pid', 0)->get();
    }

    public function tree(array $filters = []): array
    {
        $menus = $this->getTopMenus($filters);
        $tree = [];
        foreach ($menus as $menu) {
            $menuArr = $menu->toArray();
            $menuArr['meta'] = [
                'title' => $menu->title,
                'icon' => $menu->icon,
                'alwaysShow' => $menu->always_show,
                'activeMenu' => $menu->active_menu,
            ];
            $menuArr['children'] = $this->getChildren($menu, $filters);
            $tree[] = $menuArr;
        }

        return $tree;
    }

    public function getPermissions(array $filters = []): array
    {
        return $this->builder($filters)->pluck('permission')->toArray();
    }
}
