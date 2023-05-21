<?php
class VendingMachine
{
    // List of article of the vending machine
    private array $listArticles;
    // Initial balance of the vending machine
    private float $balance = 0;
    // Initial change of the vending machine
    private float $change = 0;

    /**
     * @brief This function is the contructor of the object Vending Machine
     * @param array $listArticles
     */
    public function __construct(array $listArticles){
        $this->listArticles = $listArticles;
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
     * @brief This function is designed to get the Article that has code that match th one given
     * @param string $code
     * @return Article|null
     */
    public function GetArticle(string $code) : Article|null
    {
        foreach ($this->listArticles as $article){
            if ($code == $article->GetCode()){
                return $article;
            }
        }
        return null;
    }
    /**
     * @brief This function is designed to choose a purchase inside the vending machine
     * @param string $code
     * @return string
     */
    public function Choose(string $code) : string
    {
        $selectedArticle = $this->GetArticle($code);

        if ($selectedArticle != null) {
            if ($code == $selectedArticle->GetCode()){
                if ($this->getChange() >= $selectedArticle->GetPrice()){
                    if ($selectedArticle->GetQuantity() > 0){
                        $this->change -= $selectedArticle->GetPrice();
                        $this->balance += $selectedArticle->GetPrice();
                        $selectedArticle->ReduceQuantity();
                        return "Vending " . $selectedArticle->getName();
                    }
                    return "Item " . $selectedArticle->getName() .": Out of stock!";
                }
                return "Not enough money!";
            }
        }
        return "Invalid selection!";
    }
}