<?php

namespace App\Services;

use App\DTOs\CreateCartaoDTO;
use App\DTOs\UpdateCartaoDTO;
use App\Repositories\CartaoInterface;
use stdClass;

class CartaoService {
    
    public function __construct(protected CartaoInterface $repository) {
        
    }

    public function getAll(string $filter = null): array {

        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null {

        return $this->repository->findOne($id);
    }

    public function new(CreateCartaoDTO $dto): stdClass {

        return $this->repository->new($dto);
    }

    public function update(UpdateCartaoDTO $dto): stdClass|null {

        return $this->repository->update($dto);
    }

    public function delete(string $id): void {

        $this->repository->delete($id);
    }
}