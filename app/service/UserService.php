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
        return User::query()
            ->when(!empty($filters['username']), fn($query) => $query->where('username', 'like', '%' . $filters['username'] . '%'))
            ->when(!empty($filters['status']), fn($query) => $query->where('status', $filters['status']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }

    public static function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->where('status', User::STATUS_ACTIVE)->first();
    }

    public function getRoleIds(int $userId): array
    {
        return UserRole::where('user_id', $userId)->pluck('role_id')->toArray();
    }

    public function profile(int $id): array
    {
        $user = $this->findModel($id);
        $roleIds = $this->getRoleIds($id);

        $data = $user->toArray();
        $filters = $user->isSuperAdmin() ? ['ids' => RoleService::getMenuIds($roleIds)] : [];
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

        return $user->isSuperAdmin()
            ? MenuService::instance()->getPermissions($roleIds)
            : MenuService::instance()->getPermissions(['ids' => RoleService::getMenuIds($roleIds)]);
    }
}
