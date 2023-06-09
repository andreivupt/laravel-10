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

    public function paginate(int $page = 1, int $perPage = 15, string $filter = null): PaginationPresenter
    {
        $result = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->paginate($perPage, ['*'], 'page', $page);
        //dd((new PaginationPresenter($result))->items());
        return new PaginationPresenter($result);
    }

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
        return !$support ? null : (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function new(\App\DTO\CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create(
            (array) $dto
        );

        return (object) $support->toArray();
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
