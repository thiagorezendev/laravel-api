<?php

namespace App\Http\Resources\V1;

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

    private array $types = ['B' => 'Boleto', 'C' => 'Cartão', 'P' => 'Pix'];
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullName' => $this->user->firstName . ' ' . $this->lastName,
                'email' => $this->user->email
            ],
            'paid' => $this->paid ? 'Pay' : 'No pay',
            'type' => $this->types[$this->type],
            'value' => 'RS ' . number_format($this->value, 2,',','.'),
            'paymentDate' => $this->paid ? Carbon::parse($this->payment_date)->format('d/m/Y') . ' às ' . Carbon::parse($this->payment_date)->format('H:i:s') : NULL,
            'paymentSince' => $this->paid ? Carbon::parse($this->payment_date)->diffForHumans() : NULL,
        ];
    }
}
