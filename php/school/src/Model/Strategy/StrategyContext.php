<?php

namespace Model\Strategy;

/**
 * The StrategyContext defines the interface of interest to clients.
 */
class StrategyContext{
    /**
     * @var Strategy The Context maintains a reference to one of the Strategy
     * objects. The Context does not know the concrete class of a strategy. It
     * should work with all strategies via the Strategy interface.
     */
    private $provider;

    /**
     * Usually, the StrategyContext accepts a strategy through the constructor, but also
     * provides a setter to change it at runtime.
     */
    public function __construct(ProviderInterface $provider){
        $this->provider = $provider;
    }

    /**
     * The Context delegates some work to the Strategy object instead of
     * implementing multiple versions of the algorithm on its own.
     */
    public function default($data): void{

        echo "This is a notification for ";
        $result = $this->provider->default($data);
       echo $result . "\n";

    }
}
?>