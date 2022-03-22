<?php


namespace dto;


class CustomersList
{
    /**
     * @var array|Customer[]
     */
    private array $list_of_customers = [];

    private array $list_of_customers_id = [];

    /**
     * @return array
     */
    public function getListOfCustomers(): array
    {
        return $this->list_of_customers;
    }

    public function push(Customer $call_element): void
    {
        array_push($this->list_of_customers_id, $call_element->getId());
        $this->list_of_customers[] = $call_element;
    }

    /**
     * @return array
     */
    public function getListOfCustomersId(): array
    {
        return $this->list_of_customers_id;
    }


}