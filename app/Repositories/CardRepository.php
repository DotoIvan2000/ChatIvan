<?php

namespace App\Repositories;

use App\Models\Card;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CardRepository.
 */
class CardRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Card::class;
    }
}
