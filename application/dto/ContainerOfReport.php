<?php


namespace dto;


class ContainerOfReport
{
    /**
     * @var array|ReportElement[]
     */
    private array $list = [];

    public function push(ReportElement $call_element): void
    {
        $this->list[] = $call_element;
    }

    /**
     * @return array|ReportElement[]
     */
    public function getList(): array
    {
        return $this->list;
    }

}