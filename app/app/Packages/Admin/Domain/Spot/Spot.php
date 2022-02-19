<?php


namespace App\Packages\Admin\Domain\Spot;


class Spot
{
    private int $id;
    private bool $isActive;

    const ACTIVE = true; //有効
    const INACTIVE = false; //無効

    private function __construct(){}

    public static function fromRepository(
        $id,
        $isActive
    )
    {
        $self = new self();
        $self->id = $id;
        $self->isActive = $isActive;
        return $self;
    }

    /**
     * 有効化
     * @throws \Exception
     */
    public function activate()
    {
        if ($this->getActiveFlag() === self::ACTIVE) {
            throw new \Exception('既に有効化されています。');
        }
        $this->isActive = self::ACTIVE;
    }

    /**
     * 無効化
     * @throws \Exception
     */
    public function inactivate()
    {
        if ($this->getActiveFlag() === self::INACTIVE) {
            throw new \Exception('既に無効化されています。');
        }
        $this->isActive = self::INACTIVE;
    }

    /**
     * @return bool
     */
    public function getActiveFlag()
    {
        return $this->isActive;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
