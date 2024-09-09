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
        return Dict::query()
            ->when(!empty($filters['pid']), fn($query) => $query->where('pid', $filters['pid']))
            ->when(!empty($filters['name']), fn($query) => $query->where('name', 'like', '%' . $filters['name'] . '%'))
            ->when(!empty($filters['status']), fn($query) => $query->where('status', $filters['status']))
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }

    public function options($pValue): array
    {
        $pid = Dict::where('value', $pValue)->value('id');
        if (!$pid) {
            return [];
        }

        return Dict::where('pid', $pid)->get(['value', 'name'])
            ->map(fn($dict) => [
                'value' => $dict->value,
                'label' => $dict->name
            ])->toArray();
    }
}
