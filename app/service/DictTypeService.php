<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\DictType;
use app\validator\DictTypeValidator;

class DictTypeService extends BaseService
{
    protected string $model = DictType::class;

    protected string $validator = DictTypeValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query = DictType::query();

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
}
