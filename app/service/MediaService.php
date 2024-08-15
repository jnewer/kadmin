<?php

namespace app\service;

use app\service\BaseService;
use Illuminate\Database\Eloquent\Builder;
use app\model\Media;
use app\validator\MediaValidator;

class MediaService extends BaseService
{
    protected string $model = Media::class;

    protected string $validator = MediaValidator::class;

    /**
     * @param  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $query   = Media::query();

        if (!empty($filters['created_at_start'])) {
            $query->where('created_at', '>=', $filters['created_at_start']);
        }

        if (!empty($filters['created_at_end'])) {
            $query->where('created_at', '<=', $filters['created_at_end'] . ' 23:59:59');
        }

        return $query;
    }
}
