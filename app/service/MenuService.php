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

    public function builder(array $filters = []): Builder
    {
        return Menu::query()
            ->when(!empty($filters['ids']), fn($query) => $query->whereIn('id', Arr::wrap($filters['ids'])))
            ->when(!empty($filters['status']), fn($query) => $query->where('status', $filters['status']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }

    public function getChildren(Menu $menu, array $filters = []): array
    {
        $children = !empty($filters['menuIds'])
            ? $menu->children()->whereIn('id', Arr::wrap($filters['ids']))->get()
            : $menu->children;

        return $children->map(fn($child) => [
            ...$child->toArray(),
            'children' => $this->getChildren($child, $filters)
        ])->toArray();
    }

    public function getTopMenus(array $filters = []): Collection
    {
        return $this->builder($filters)->where('pid', 0)->get();
    }

    public function tree(array $filters = []): array
    {
        return $this->getTopMenus($filters)->map(fn($menu) => [
            ...$menu->toArray(),
            'meta' => [
                'title' => $menu->title,
                'icon' => $menu->icon,
                'alwaysShow' => $menu->always_show,
                'activeMenu' => $menu->active_menu,
            ],
            'children' => $this->getChildren($menu, $filters)
        ])->toArray();
    }

    public function getPermissions(array $filters = []): array
    {
        return $this->builder($filters)->pluck('permission')->toArray();
    }
}
