<?php

namespace App\Services;

class CalculationService 
{

    private $total_price;

    public function __construct($total_price)
    {
        $this->total_price = $total_price;
    }

   public function totalaftertaxes()
   {

        return $this-taxesvalue() + $this->total_price;
       
   }

   public function totalcost($discount)
   {
          if ($discount>=1) {
               return $this->totalaftertaxes();
          }
        return $this->totalaftertaxes()-($this->totalaftertaxes() * $discount);
       
   }

   public function taxesvalue()
   {
          
        return $this->Consumption() + $this->Locat_administration() + $this->Rebuild_tax();
       
   }

   public function Rebuild_tax()
   {

        return $this->total_price*0.05;
       
   }

   public function Locat_administration()
   {

        return $this->total_price*0.01;
       
   }

   public function  Consumption()
   {

       return $this->total_price*0.1;

   }
}