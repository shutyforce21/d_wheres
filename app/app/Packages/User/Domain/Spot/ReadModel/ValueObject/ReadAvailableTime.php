<?php


namespace App\Packages\User\Domain\Spot\ReadModel\ValueObject;


class ReadAvailableTime
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
