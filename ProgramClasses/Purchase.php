<?php

class Purchase
{
    private DateTime $date;
    private float $amount;
    public function __construct(DateTime $date, float $amount){
        $this->date = $date;
        $this->amount = $amount;
    }
    public function GetDate() : DateTime
    {
        return $this->date;
    }
    public function GetAmount() : float
    {
        return $this->amount;
    }
}