<?php

namespace app\service;

interface ServiceInterface
{
    public function list(array $filters = []);

    public function all(array $filters = []);

    public function detail(int $id);

    public function create(array $data);

    public function update(int $id, $data);

    public function delete(int $id);

    public function builder(array $filters = []);
}
