<?php

namespace TestClasses;

use AllowDynamicProperties;
use Article;
use PHPUnit\Framework\TestCase;
use VendingMachine;
use SaleStatistic;

require_once dirname(__FILE__) . "/../ProgramClasses/Article.php";
require_once dirname(__FILE__) . "/../ProgramClasses/VendingMachine.php";
require_once dirname(__FILE__) . "/../ProgramClasses/SaleStatistic.php";


class testsVendingMachine extends TestCase
{
    private VendingMachine $testVendingMachine;
    protected function setUp(): void
    {
        // Create new object of type VendingMachine
        $this->testVendingMachine = new VendingMachine([
            new Article("Smarlies", "A01", 10, 1.60),
            new Article("Carampar", "A02", 5, 0.60),
            new Article("Avril", "A03", 2, 2.10),
            new Article("KokoKola", "A04", 1, 2.95)
        ]);
        $this->testSaleStatistic = new SaleStatistic();
    }
    public function testChoose_A01EnoughAmount_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(3.40);
        // When
        // Store the message returned by the function choose to assert it after
        $messageAfterChoose = $this->testVendingMachine->Choose("A01");
        // Then
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Vending Smarlies', $messageAfterChoose);
        // Verify if the change left after calling function choose match with expected change
        $this->assertSame(1.80, $this->testVendingMachine->GetChange());
    }
    public function testChoose_A03EnoughAmount_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(2.10);
        // When
        // Store the message returned by the function choose to assert it after
        $messageAfterChoose = $this->testVendingMachine->Choose("A03");
        // Then
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Vending Avril', $messageAfterChoose);
        // Verify if the change left after calling function choose match with expected change
        $this->assertSame(0.00, $this->testVendingMachine->GetChange());
        $this->assertSame(2.10, $this->testVendingMachine->GetBalance());
    }
    public function testChoose_A01NotEnoughAmount_Success() : void
    {
        // Given
        // When
        // Store the message returned by the function choose to assert it after
        $messageAfterChoose = $this->testVendingMachine->Choose("A01");
        // Then
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Not enough money!', $messageAfterChoose);
    }
    public function testChoose_A01NotEnoughAmountAndA02EnoughAmount_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(1.00);
        // When + Then
        // Verify the message returned by the function choose with A01 param and match it with the expected message
        $this->assertSame('Not enough money!', $this->testVendingMachine->Choose("A01"));
        // Verify if the change left after calling function choose with A01 and match it with expected change
        $this->assertSame(1.00, $this->testVendingMachine->GetChange());
        // Verify the message returned by the function choose with A02 param and match it with the expected message
        $this->assertSame('Vending Carampar', $this->testVendingMachine->Choose("A02"));
        // Verify if the change left after calling function choose with A02 and match it with expected change
        $this->assertSame(0.40, $this->testVendingMachine->GetChange());
    }
    public function testChoose_A05InvalidSelection_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(1.00);
        // When
        // Store the message returned by the function choose to assert it after
        $messageAfterChoose = $this->testVendingMachine->Choose("A05");
        // Then
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Invalid selection!', $messageAfterChoose);
    }
    public function testChoose_A04TwoTimeEnoughAmountButNotEnoughQuantity_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(6.00);
        // When
        // Store the message returned by the function choose to assert it after
        $message1AfterChoose = $this->testVendingMachine->Choose("A04");
        $message2AfterChoose = $this->testVendingMachine->Choose("A04");
        // Then
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Vending KokoKola', $message1AfterChoose);
        // Verify the message returned by the function choose match with the expected message
        $this->assertSame('Item KokoKola: Out of stock!', $message2AfterChoose);
        // Verify if the change left after calling function choose with A04 and match it with expected change
        $this->assertSame(3.05, $this->testVendingMachine->GetChange());
    }
    public function testChoose_MultipleChoose_Success() : void
    {
        // Given
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(6.00);
        // When + Then
        // Verify the message returned by the function choose with A04 param and match it with the expected message
        $this->assertSame('Vending KokoKola', $this->testVendingMachine->Choose("A04"));
        // Insert again some money in the vending machine
        $this->testVendingMachine->Insert(6.00);
        // Verify the message returned by the function choose with A04 param and match it with the expected message
        $this->assertSame('Item KokoKola: Out of stock!', $this->testVendingMachine->Choose("A04"));
        // Verify the message returned by the function choose with A01 param and match it with the expected message
        $this->assertSame('Vending Smarlies', $this->testVendingMachine->Choose("A01"));
        // Verify the message returned by the function choose with A04 param and match it with the expected message
        $this->assertSame('Vending Carampar', $this->testVendingMachine->Choose("A02"));
        // Verify the message returned by the function choose with A04 param and match it with the expected message
        $this->assertSame('Vending Carampar', $this->testVendingMachine->Choose("A02"));
        // Verify if the change left after calling all function choose and match it with expected change
        $this->assertSame(6.25, $this->testVendingMachine->GetChange());
        // Verify if the balance left after calling all function choose and match it with expected balance
        $this->assertSame(5.75, $this->testVendingMachine->GetBalance());
    }
    public function testGetBestHourOfTheDay_GetBestHourOfTheDay_Success() : void
    {
        // Given
        // Create new object of type VendingMachine
        $this->testVendingMachine = new VendingMachine([
            new Article("Smarlies", "A01", 100, 1.60),
            new Article("Carampar", "A02", 50, 0.60),
            new Article("Avril", "A03", 20, 2.10),
            new Article("KokoKola", "A04", 10, 2.95)
        ]);
        // Insert money in the vending machine
        $this->testVendingMachine->Insert(1000.00);
        $this->testSaleStatistic->SetTime("2020-01-01T20:30:00");
        $this->testVendingMachine->Choose("A01");
        $this->testSaleStatistic->SetTime("2020-03-01T23:30:00");
        $this->testVendingMachine->Choose("A01");
        $this->testSaleStatistic->SetTime("2020-03-01T09:22:00");
        $this->testVendingMachine->Choose("A01");
        $this->testSaleStatistic->SetTime("2020-04-01T23:00:00");
        $this->testVendingMachine->Choose("A01");
        $this->testSaleStatistic->SetTime("2020-04-01T23:59:59");
        $this->testVendingMachine->Choose("A01");
        $this->testSaleStatistic->SetTime("2020-04-01T09:12:00");
        $this->testVendingMachine->Choose("A01");
        // When
        $getBestHours = $this->testSaleStatistic->GetBestsHours();
        // Then
        $this->assertEquals($getBestHours[0], "Hour 23 generated a revenue of 4.80");
        $this->assertEquals($getBestHours[1], "Hour 9 generated a revenue of 3.20");
        $this->assertEquals($getBestHours[2], "Hour 20 generated a revenue of 1.60");
    }
}
