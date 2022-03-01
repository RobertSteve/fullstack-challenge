<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class GetAllTasksServices
{

    public function run()
    {
        return Task::all()->groupBy('stage')->map(function($cards) {
            return $cards->map(function ($card) {
                $estimationAt = Carbon::parse($card->estimation_at);
                $createdAt = Carbon::parse($card->created_at);
                $deliveryAt = Carbon::parse($card->delivery_at);
                return [
                    'id' => $card->id,
                    'name' => $card->name,
                    'stage' => $card->stage,
                    'created_at' => $card->created_at,
                    'estimation_at' => $card->estimation_at,
                    'delivery_at' => $card->delivery_at,
                    'created_at_format' => $createdAt->day.' '.ucfirst($createdAt->monthName).' '.$createdAt->format('h:m A'),
                    'estimation_at_format' => $estimationAt->day.' '.ucfirst($estimationAt->monthName),
                    'delivery_at_format' => $deliveryAt->day.' '.ucfirst($deliveryAt->monthName),
                ];
            });
        });
    }

}
