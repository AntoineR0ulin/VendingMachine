<?php
require_once dirname(__FILE__) . "/SaleStatistic.php";
class VendingMachine
{
    // List of article of the vending machine
    private array $listArticles;
    // Initial balance of the vending machine
    private float $balance = 0;
    // Initial change of the vending machine
    private float $change = 0;
    private SaleStatistic $saleStatistic;

    /**
     * @brief This function is the contructor of the object Vending Machine
     * @param array $listArticles
     */
    public function __construct(array $listArticles){
        $this->listArticles = $listArticles;
        $this->saleStatistic = new SaleStatistic();
    }
    /**
     * @brief This function is the getter of the property Change
     * @return float
     */
    public function GetChange() : float
    {
        return round($this->change, 2);
    }
    /**
     * @brief This function is the getter of the property Change
     * @return float
     */
    public function GetBalance() : float
    {
        return round($this->balance, 2);
    }
    /**
     * @brief This function is designed to increment the amount available for purchase
     * @param float $amount
     * @return void
     */
    public function Insert(float $amount) : void
    {
        $this->change += $amount;
    }
    /**
     * @brief This function is designed to choose a purchase inside the vending machine
     * @param string $code
     * @return string
     */
    public function Choose(string $code) : string
    {
        foreach ($this->listArticles as $article){
            if ($code == $article->GetCode()){
                if ($this->getChange() >= $article->GetPrice()){
                    if ($article->GetQuantity() > 0){
                        $this->change -= $article->GetPrice();
                        $this->balance += $article->GetPrice();
                        $this->saleStatistic->AddPurchase($article->GetPrice());
                        $article->ReduceQuantity();
                        return "Vending " . $article->getName();
                    }
                    return "Item " . $article->getName() .": Out of stock!";
                }
                return "Not enough money!";
            }
        }
        return "Invalid selection!";
    }
}