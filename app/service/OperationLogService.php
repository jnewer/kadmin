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

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query = OperationLog::query();

        if (!empty($filters['admin_username'])) {
            $query->where('admin_username', 'like', '%'. $filters['admin_username']. '%');
        }

        if (!empty($filters['method'])) {
            $query->where('method', $filters['method']);
        }
        
        if (!empty($filters['created_at_start'])) {
            $query->where('created_at', '>=', $filters['created_at_start']);
        }

        if (!empty($filters['created_at_end'])) {
            $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59');
        }

        return $query;
    }
}
