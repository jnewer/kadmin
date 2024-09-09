<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\OperationLog;
use app\validator\OperationLogValidator;

/**
 * @method OperationLog findModel(int $id)
 */
class OperationLogService extends BaseService
{
    protected string $model = OperationLog::class;

    protected string $validator = OperationLogValidator::class;

    public function builder(array $filters = []): Builder
    {
        return OperationLog::query()
            ->when(!empty($filters['username']), fn($query) => $query->where('username', 'like', '%' . $filters['username'] . '%'))
            ->when(!empty($filters['method']), fn($query) => $query->where('method', $filters['method']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }
}
