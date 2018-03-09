<?php
class Product {
    public $name;
    public $price;
    
    public function __construct($name, $price){
        $this->name = $name;
        $this->price = $price;
    }
}


class ShoppingCart {
    private $cart;
    
    public function __construct() {
        $this -> cart = [];
    }
    
    public function add_product( $product ) {
        $name = $product->name;
        
        if( !array_key_exists($name, $this->cart) ) {
            $this->cart[$name]['product'] = $product;
            $this->cart[$name]['quantity'] = 0;
        }
        
        $this->cart[$name]['quantity'] += 1;
    }
    
    public function delete_product( $product ) {
        $name = $product->name;
        
        if( !array_key_exists($name, $this->cart) ) {          
            return false;            
        }
        //remove one item of product
        if ($this->cart[$name]['quantity'] > 0) {
            $this->cart[$name]['quantity'] -= 1;
        }
        //if there is no items lef drop product from array
        if ($this->cart[$name]['quantity'] === 0) {
           unset($this->cart[$name]);
        }
     
        return true;
    }
    
    public function get_value() {
        $val = 0;
        forEach($this->cart as $name=>$item) {
            $val += $item['quantity'] * $item['product']->price;
        }
        
        return $val;
    }
    
    public function display_cart() {
        print("<br/>Currently in my cart: <br/>");
        
        forEach($this->cart as $name=>$item) {
            print $name.": ".$item['product']->price." EUR, ".$item['quantity']." unit(s)<br/>";
        }
    }
}
?>
