<?php


namespace App\Repository;


use App\Entity\UserFonction;
use Illuminate\Database\Eloquent\Collection;

class UserFonctionRepository
{
    /**
     * @var UserFonction
     */
    private UserFonction $userFonction;

    /**
     * UserFonctionRepository constructor.
     * @param UserFonction $userFonction
     */
    public function __construct(UserFonction $userFonction)
    {
        $this->userFonction = $userFonction;
    }

    public function getAll(): Collection
    {
        return $this->userFonction->all();
    }
}
