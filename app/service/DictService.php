<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\Dict;
use app\validator\DictValidator;

/**
 * @method Dict findModel(int $id)
 */
class DictService extends BaseService
{
    protected string $model = Dict::class;

    protected string $validator = DictValidator::class;

    public function builder(array $filters = []): Builder
    {
        $query = Dict::query();

        if (!empty($filters['pid'])) {
            $query->where('pid', $filters['pid']);
        }

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
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

    public function options($pValue)
    {
        $pid = Dict::where('value', $pValue)->value('id');
        if (!$pid) {
            return [];
        }

        $dicts = Dict::where('pid', $pid)->get(['value', 'name']);
        return $dicts->map(function ($dict) {
            return [
                'value' => $dict->value,
                'label' => $dict->name
            ];
        })->toArray();
    }
}
