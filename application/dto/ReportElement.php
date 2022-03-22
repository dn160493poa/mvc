<?php


namespace dto;


class ReportElement
{
    private int $customer_id;

    private int $callToSameContinent;

    private int $durationToSameContinent;

    private int $totalCalls;

    private int $totalDuration;

    /**
     * ReportElement constructor.
     * @param int $callToSameContinent
     * @param int $durationToSameContinent
     * @param int $totalCalls
     * @param int $totalDuration
     */
    public function __construct(int $customer_id, int $callToSameContinent, int $durationToSameContinent, int $totalCalls, int $totalDuration)
    {
        $this->customer_id = $customer_id;
        $this->callToSameContinent = $callToSameContinent;
        $this->durationToSameContinent = $durationToSameContinent;
        $this->totalCalls = $totalCalls;
        $this->totalDuration = $totalDuration;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    /**
     * @return int
     */
    public function getCallToSameContinent(): int
    {
        return $this->callToSameContinent;
    }

    /**
     * @return int
     */
    public function getDurationToSameContinent(): int
    {
        return $this->durationToSameContinent;
    }

    /**
     * @return int
     */
    public function getTotalCalls(): int
    {
        return $this->totalCalls;
    }

    /**
     * @return int
     */
    public function getTotalDuration(): int
    {
        return $this->totalDuration;
    }




}