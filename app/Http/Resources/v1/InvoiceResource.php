<?php

namespace App\Http\Resources\v1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     private array $types = [
        'C' => 'Cartão',
        'B' => 'Boleto',
        'P' => 'Pix',
     ];

    public function toArray(Request $request): array
    {
        return [
            'owner' => [
                'fullName' => $this->user->firstName . ' ' . $this->user->lastName,
            ],
            'type' => $this->types[$this->type],
            'value' => 'R$ ' . number_format($this->value, 2, ','),
            'isPaid' => $this->isPaid ? 'Paid' : 'Not paid',
            'payment_date' => $this->isPaid ? Carbon::parse($this->payment_date)->format('d/m/Y H:i:s') : null,
            'paid_since' => $this->isPaid ? Carbon::parse($this->payment_date)->diffForHumans() : null,
         ];
    }
}
