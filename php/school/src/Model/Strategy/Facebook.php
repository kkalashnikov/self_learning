<?php

namespace Model\Strategy;

use Model\Strategy\ProviderInterface;

/**
 * Concrete Strategies implement the algorithm while following the base Strategy
 * interface. The interface makes them interchangeable in the Context.
 */
class Facebook implements ProviderInterface{
    public function default(array $data): string{
        $data = "Facebook, Facebook Message to ".$data['name'];
        return $data;
    }
}

?>