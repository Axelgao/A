<?php

/**
 * 159.339 Internet Programming Assignment 3
 * Team Student : Shenchuan Gao (16131180)
 */

/**
 * Tool class
 * Contains information of tools.
 */
class Tool
{
    // Id
    private $id = NULL;
    // SKU
    private $sku = NULL;
    // Tool Name
    private $toolName = NULL;
    // Tool Category
    private $category = NULL;
    // Cost
    private $cost = 0.00;
    // Stock QTY
    private $stockQTY = 0.0;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    
    public function getSKU(){
        return $this->sku;
    }
    public function setSKU($sku){
        $this->sku = $sku;
    }
    
    public function getToolName(){
        return $this->toolName;
    }
    public function setToolName($toolName){
        $this->toolName = $toolName;
    }
    
    public function getCategory(){
        return $this->category;
    }
    public function setCategory($category){
        $this->category = $category;
    }
    
    public function getCost(){
        return $this->cost;
    }
    public function setCost($cost){
        $this->cost = $cost;
    }
    
    public function getsStockQTY(){
        return $this->stockQTY;
    }
    public function setStockQTY($stockQTY){
        $this->stockQTY = $stockQTY;
    }

}
