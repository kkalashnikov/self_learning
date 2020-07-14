<?php

namespace Model\Strategy;

use Model\Strategy\ProviderInterface;

/**
 * Concrete Strategies implement the algorithm while following the base Strategy
 * interface. The interface makes them interchangeable in the Context.
 */
class Whatsapp implements ProviderInterface{
    public function default(array $data): string{
        $data = "Whatsapp, Message to ".$data['name'];
        return $data;
    }
}

?>