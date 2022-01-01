<?php


namespace App\Packages\User\Domain\Spot\ValueObject;


use Carbon\Carbon;

class AvailableTime
{
    private $openOn;
    private $closeOn;

    public function __construct(
        $openOn,
        $closeOn
    )
    {
        $this->openOn = $openOn;
        $this->closeOn = $closeOn;
    }

    /**
     * @return mixed
     */
    public function getOpenOn()
    {
        return $this->openOn;
    }

    /**
     * @return mixed
     */
    public function getCloseOn()
    {
        return $this->closeOn;
    }
}
