<?php

namespace App\Repositories;

use App\DTOs\CreateCartaoDTO;
use App\DTOs\UpdateCartaoDTO;
use stdClass;

interface CartaoInterface {

    public function getAll(string $filter = null): array;

    public function findOne(string $id): stdClass|null;

    public function delete(string $id): void;

    public function new(CreateCartaoDTO $dto): stdClass;

    public function update(UpdateCartaoDTO $dto): stdClass|null;
}