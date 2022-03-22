<?php


namespace dto;


class Reporting
{
    public function getReportingOfCustomers($calls) : ContainerOfReport
    {
        $customers = $this->getUniqCustomers($calls);

        $container_of_reports = new ContainerOfReport();

        foreach ($customers->getListOfCustomers() as $customer){
            // start data
            $toSameContinentDuration  = 0;
            $toSameContinentCalls = 0;
            $totalDuration = 0;
            $totalCalls = 0;

            foreach ($calls->getList() as $call){
                if($call->getCustomerId() === $customer->getId()){
                    if($call->getDialedContinent() === $customer->getContinent()){
                        $toSameContinentDuration += $call->getDuration();
                        $toSameContinentCalls++;
                    }
                    $totalDuration += $call->getDuration();
                    $totalCalls++;
                }

            }

            $report_element = new ReportElement(
                (int) $customer->getId(),
                (int) $toSameContinentCalls,
                (int) $toSameContinentDuration,
                (int) $totalCalls,
                (int) $totalDuration,
            );

            $container_of_reports->push($report_element);
        }
        return $container_of_reports;
    }

    private function getUniqCustomers ($calls) : CustomersList
    {
        $customers = new CustomersList();
        foreach ($calls->getList() as $call) {
            $customer = new Customer($call->getCustomerId(), $call->getDialedContinent());

            if (!in_array($customer->getId(), $customers->getListOfCustomersId())) {
                $customers->push($customer);
            }
        }

        return $customers;
    }

}