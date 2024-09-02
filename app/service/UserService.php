<?php

namespace app\service;

use app\model\User;
use app\model\UserRole;
use app\service\BaseService;
use app\validator\UserValidator;
use Illuminate\Database\Eloquent\Builder;

class UserService extends BaseService
{
    protected string $model = User::class;

    protected string $validator = UserValidator::class;

    public function builder(array $filters = []): Builder
    {
        $query = User::query();

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

    public static function findByUsername(string $username): User|null
    {
        return User::where('username', $username)->where('status', User::STATUS_ACTIVE)->first();
    }

    public function getRoleIds(int $userId): array
    {
        return UserRole::where('user_id', $userId)->get()->pluck('role_id')->toArray();
    }

    public function profile(int $id): array
    {
        $user = $this->findModel($id);
        $roleIds = $this->getRoleIds($id);

        $data = $user->toArray();
        $filters = [];
        if ($user->isSuperAdmin()) {
            $filters['ids'] = RoleService::getMenuIds($roleIds);
        }
        $data['menus'] = MenuService::instance()->tree($filters);

        return $data;
    }

    public function changePassword(int $id, array $data): bool
    {
        $data = UserValidator::instance()->validated($data, 'changePassword');

        $user = $this->findModel($id);
        $user->password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        return $user->save();
    }

    public function getPermissions(int $id): array
    {
        $user = $this->findModel($id);

        $roleIds = $this->getRoleIds($id);

        if ($user->isSuperAdmin()) {
            return MenuService::instance()->getPermissions($roleIds);
        }

        return MenuService::instance()->getPermissions(['ids' => RoleService::getMenuIds($roleIds)]);
    }
}
