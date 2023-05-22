<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{

    public function __construct(
        protected Support $model
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if ($filter) {
                            $query->where('subject', $filter);
                            $query->orWhere('body', 'like', "%{$filter}%");
                        }
                    })
                    ->get()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $support = $this->model->find($id);

        /*if (!$support) {
            return null;
        }
        return (object) $support->toArray;*/

        return !$support ? null : $support->toArray;
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function new(\App\DTO\CreateSupportDTO $dto): stdClass
    {
        return (object) $this->model->create(
            (array) $dto
        );
    }

    public function update(\App\DTO\UpdateSupportDTO $dto): stdClass|null
    {
         if (!$support = $this->model->find($dto->id)) {
             return null;
         }

         $support->update(
             (array) $dto
         );

        return (object) $support->toArray();
    }
}
