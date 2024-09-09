<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\Config;
use app\validator\ConfigValidator;

/**
 * @method Config findModel(int $id)
 */
class ConfigService extends BaseService
{
    protected string $model = Config::class;

    protected string $validator = ConfigValidator::class;

    public function builder(array $filters = []): Builder
    {
        return Config::query()
            ->when(!empty($filters['created_at_start']), fn($query) => $query->where('created_at', '>=', $filters['created_at_start']))
            ->when(!empty($filters['created_at_end']), fn($query) => $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59'));
    }
}
