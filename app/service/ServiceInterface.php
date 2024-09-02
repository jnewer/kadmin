<?php

namespace app\service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;

interface ServiceInterface
{
    public function list(array $filters = []): array;

    public function all(array $filters = []): Collection;

    public function detail(int $id): mixed;

    public function create(array $data) :mixed;

    public function update(int $id, $data): bool;

    public function delete(int $id): mixed;

    public function builder(array $filters = []):Builder;
}
