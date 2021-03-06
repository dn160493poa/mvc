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

    /**
     * @return array|CallElement[]
     */
    public function getList(): array
    {
        return $this->list;
    }



}