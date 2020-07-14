<?php

namespace Model\Strategy;

use Model\Strategy\ProviderInterface;

/**
 * Concrete Strategies implement the algorithm while following the base Strategy
 * interface. The interface makes them interchangeable in the Context.
 */
class Email implements ProviderInterface{
    public function default(array $data): string{
        $data = "Email, Email to ".$data['name'];
        return $data;
    }
}

?>