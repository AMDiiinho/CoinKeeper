<?php


namespace App\Repositories;

use App\Models\Cartao;
use App\Repositories\CartaoInterface;
use App\DTOs\CreateCartaoDTO;
use App\DTOs\UpdateCartaoDTO;
use stdClass;


class CartaoEloquentORM implements CartaoInterface {
    public function __construct(protected Cartao $model){

    }

    public function getAll(string $filter = null): array {

        return $this->model
                    ->where(function ($query) use($filter){
                        if ($filter) {
                            $query->where('nome', $filter);
                            $query->orWhere('tipo', 'like', "%{$filter}%");
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null {

        $cartao = $this->model->find($id);
        if (!$cartao) {
            return null;
        }

        return (object) $cartao->toArray();

    }

    public function delete(string $id): void {


        $this->model->findOrFail($id)->delete();

    }
    public function new(CreateCartaoDTO $dto): stdClass {

        $cartao = $this->model->create((array) $dto);

        return (object) $cartao->getAttributes();
    }

    public function update(UpdateCartaoDTO $dto): stdClass|null {

       if (!$cartao = $this->model->find($dto->id)) {
            return null;
       }

       $cartao->update((array) $dto);

       return (object) $this->model->update((array) $dto);
    }
}

