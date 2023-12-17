<?php

namespace App\Http\Controllers\Api\Cards;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest\CardRequest;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends BaseApiController
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
    public function registerCard($user_id, CardRequest $request)
    {
        try {
            $card = $this->cardService->registerCard($user_id, $request->validated());
            return $this->returnInfoSuccess($card);
        } catch (\Throwable $th) {
            return $this->returnInfoError($th->getMessage(), 500);
        }
    }
}
