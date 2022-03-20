<?php

namespace dto;

class ContainerOfCalls
{
    /**
     * @var array|CallElement[]
     */
    private array $list = [];

    public function push(CallElement $call_element): void
    {
        $this->list[] = $call_element;
    }

    public function get(): array
    {
        $output = [];

        foreach ($this->list as $call_element) {
            $output[$call_element->getCustomerId()] = [];
        }

        return $output;
    }
}