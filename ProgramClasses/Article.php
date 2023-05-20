<?php
class Article
{
    // Name of the article
    private string $name;
    // Code of the article
    private string $code;
    // Quantity of the article
    private int $quantity;
    // Price of the article
    private float $price;
    /**
     * @brief This function is the contructor of the object Article
     * @param string $name
     * @param string $code
     * @param int $quantity
     * @param float $price
     */
    public function __construct(string $name, string $code, int $quantity, float $price)
    {
        $this->name = $name;
        $this->code = $code;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    /**
     * @brief This function is the getter of the property Name
     * @return string
     */
    public function GetName() : string
    {
        return $this->name;
    }
    /**
     * @brief This function is the getter of the property Code
     * @return string
     */
    public function GetCode() : string
    {
        return $this->code;
    }
    /**
     * @brief This function is the getter of the property Quantity
     * @return int
     */
    public function GetQuantity() : int
    {
        return $this->quantity;
    }
    /**
     * @brief This function is designed to decrement quantity when this item is bought
     * @return void
     */
    public function ReduceQuantity() : void
    {
        $this->quantity--;
    }
    /**
     * @brief This function is the getter of the property Price
     * @return float
     */
    public function GetPrice() : float
    {
        return $this->price;
    }
}