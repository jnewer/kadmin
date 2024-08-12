<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\Option;
use app\validator\OptionValidator;

class OptionService extends BaseService
{
    protected string $model = Option::class;

    protected string $validator = OptionValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query   = Option::query();

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
