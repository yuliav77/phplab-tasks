<?php

namespace src\oop\commands;

class DivCommand implements CommandInterface
{    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        } elseif ($args[1] === 0) {
            throw new \InvalidArgumentException('Can\'t divide by zero');
        }

        return $args[0] / $args[1];
    }
}