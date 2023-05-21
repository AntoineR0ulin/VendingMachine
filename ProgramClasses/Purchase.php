<?php
class Purchase
{
    // Date of the purchase
    private DateTime $date;
    // Amount of the purchase
    private float $amount;
    /**
     * @brief This function is the constructor of this class
     * @param DateTime $date
     * @param float $amount
     */
    public function __construct(DateTime $date, float $amount){
        $this->date = $date;
        $this->amount = $amount;
    }
    /**
     * @brief This function is designed to get the date of this object purchase
     * @return DateTime
     */
    public function GetDate() : DateTime
    {
        return $this->date;
    }
    /**
     * @brief This function is designed to get the amount of this object purchase
     * @return float
     */
    public function GetAmount() : float
    {
        return $this->amount;
    }
}