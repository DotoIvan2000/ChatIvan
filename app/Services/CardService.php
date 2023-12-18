<?php

namespace App\Services;

use App\Models\PendingApprove;
use App\Repositories\CardRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CardService.
 */
class CardService
{
    protected $cardRepository;
    protected $userRepository;

    public function __construct(CardRepository $cardRepository, UserRepository $userRepository)
    {
        $this->cardRepository = $cardRepository;
        $this->userRepository = $userRepository;
    }
    public function registerCard($user_id, $data)
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = $user_id;
            $card = $this->cardRepository->create($data);
            PendingApprove::create([
                'user_id' => $user_id,
            ]);
            DB::commit();
            return $card;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}
