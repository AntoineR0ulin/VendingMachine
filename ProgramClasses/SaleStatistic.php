<?php
require_once dirname(__FILE__) . "/Purchase.php";
class SaleStatistic
{
    private array $sales = [];
    private string $dateOfPurchase = "";
    public function SetTime(string $dateCustom) : void
    {
        $this->dateOfPurchase = date_format(new DateTime($dateCustom), 'H');
    }
    public function AddPurchase(float $amount) : void
    {
        if ($this->dateOfPurchase == ""){
            $this->dateOfPurchase = date_format(new DateTime('now'), 'H');
        }
        $this->sales[] = new Purchase($this->dateOfPurchase, $amount);
    }

    public function GetBestsHours(int $limitOfDisplayHours = 3) : string
    {
        $topTreeHours = [];
        $listOfHour = [];
        for ($i = 0; $i < 24; $i++){
            foreach ($this->sales as $sale){
                $heure = date_format($sale->GetDate(), 'H');
                if ($heure == $i){
                    $totalAmountOfHour = $sale->GetAmount();
                }
            }
            $listOfHour[$i] = $totalAmountOfHour;
        }
        arsort($listOfHour);
        return $topTreeHours;
    }
}