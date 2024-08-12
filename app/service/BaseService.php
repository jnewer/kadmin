<?php

namespace app\service;

use support\Model;
use app\validator\BaseValidator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read BaseValidator $validator
 * @property-read Model $model
 */
class BaseService implements ServiceInterface
{
    protected string $model;

    protected string $validator;

    public static function instance(): static
    {
        return new static();
    }

    public function findModel(int $id): Model
    {
        return $this->modelQuery()->findOrFail($id);
    }

    public function list(array $filters = []): array
    {
        $paginator = $this->builder($filters)->orderByDesc('id')->paginate();

        return [
            'items' => $paginator->items(),
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
        ];
    }

    public function all(array $filters = []): Collection
    {
        return $this->builder($filters)->get();
    }

    public function detail(int $id): mixed
    {
        return $this->findModel($id);
    }

    public function create(array $data): mixed
    {
        $data = $this->validator::instance()->validated($data, 'create');
        return $this->model::create($data);
    }

    public function update(int $id, $data): bool
    {
        $data = $this->validator::instance()->validated($data, 'update');
        return $this->findModel($id)->update($data);
    }

    public function delete(int $id): mixed
    {
        return $this->findModel($id)->delete();
    }

    public function builder(array $filters = []): Builder
    {
        return $this->modelQuery();
    }

    private function modelQuery(): Builder
    {
        return $this->model::query();
    }

    public function status(int $id, int $status): bool
    {
        return $this->findModel($id)->update(['status' => $status]);
    }
}
