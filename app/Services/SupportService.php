<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\PaginationInterface;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(
        protected SupportRepositoryInterface $repository
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll();
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string|int $id): void
    {
        $this->repository->delete();
    }

    public function paginate(
        int $page = 1,
        int $perPage = 15,
        string $filter = null
    ): PaginationInterface
    {
        return $this->repository->paginate(
            page: $page,
            perPage: $perPage,
            filter: $filter
        );
    }
}
