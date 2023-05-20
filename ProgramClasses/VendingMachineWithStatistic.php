<?php
class VendingMachineWithStatistic extends VendingMachine
{
    private array $purchases;
    private DateTime $dateOfPurchase;
    private bool $setTimeUsed;
    public function __construct(array $listArticles)
    {
        $this->dateOfPurchase = new DateTime('now');
        $this->purchases = [];
        $this->setTimeUsed = false;
        parent::__construct($listArticles);
    }
    public function SetTime(string $date) : void
    {
        try {
            $this->dateOfPurchase = new DateTime($date);
            $this->setTimeUsed = true;
        }
        catch (Exception){
            // TODO Return error message
        }
    }
    public function Choose(string $code) : string
    {
        if (!$this->setTimeUsed){
            $this->dateOfPurchase = new DateTime('now');
        }
        $selectedArticle = $this->GetArticle($code);
        $result = parent::Choose($code);
        if ($selectedArticle != null && $result == "Vending " . $selectedArticle->getName()){
            $this->purchases[] = new Purchase($this->dateOfPurchase, $selectedArticle->GetPrice());
        }
        return parent::Choose($code);
    }

    public function GetBestHours(int $limitDisplayedHours = 3) : array
    {
        $listOfHour = [];
        $listOfAmount = [];
        for ($i = 0; $i < 24; $i++){
            $listOfHour[$i] = $i;
            $listOfAmount[$i] = 0;
        }
        foreach ($this->purchases as $purchase){
            $hour = intval(date_format($purchase->GetDate(), 'H'));
            $listOfAmount[$hour] += $purchase->GetAmount();
        }
        array_multisort($listOfAmount, SORT_DESC, $listOfHour, SORT_DESC);
        for ($i = 0; $i <= $limitDisplayedHours; $i++){
            $topTreeArray[$i] = [$listOfHour[$i], $listOfAmount[$i]];
        }
        //arsort($listOfHour);
        return $topTreeArray;
    }
}