<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\LoginLog;
use app\validator\LoginLogValidator;

/**
 * @method LoginLog findModel(int $id)
 */
class LoginLogService extends BaseService
{
    protected string $model = LoginLog::class;

    protected string $validator = LoginLogValidator::class;

    public function builder(array $filters = []): Builder
    {
        return LoginLog::query()
            ->when(!empty($filters['username']), fn($query) => $query->where('username', 'like', '%' . $filters['username'] . '%'))
            ->when(!empty($filters['status']), fn($query) => $query->where('status', $filters['status']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }
}
