<?php

use App\Models\Support;
use App\Services\SupportRepositoryInterface;

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
                    ->all()
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
        // TODO: Implement new() method.
    }

    public function update(\App\DTO\UpdateSupportDTO $dto): stdClass|null
    {
        // TODO: Implement update() method.
    }
}
