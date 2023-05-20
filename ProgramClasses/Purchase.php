<?php

class Purchase
{
    private string $date;
    private float $amount;
    public function __construct(string $date, float $amount){
        $this->date = $date;
        $this->amount = $amount;
    }
    public function GetDate() : string
    {
        return $this->date;
    }
    public function GetAmount() : float
    {
        return $this->amount;
    }
}