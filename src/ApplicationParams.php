<?php


namespace PiwikPRO;


/**
 * Class ApplicationParams
 * @package PiwikPRO
 */
class ApplicationParams
{
    /**
     * @var string
     */
    private string $deliveryAddress;

    /**
     * @var string
     */
    private string $dbHost;

    /**
     * @var string
     */
    private string $dbUser;

    /**
     * @var string
     */
    private string $dbPass;

    /**
     * @var string
     */
    private string $dbDatabase;

    /**
     * @return string
     */
    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     */
    private function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string
     */
    public function getDbPass(): string
    {
        return $this->dbPass;
    }

    /**
     * @param string $dbPass
     */
    private function setDbPass(string $dbPass): void
    {
        $this->dbPass = $dbPass;
    }

    /**
     * @return string
     */
    public function getDbUser(): string
    {
        return $this->dbUser;
    }

    /**
     * @param string $dbUser
     */
    private function setDbUser(string $dbUser): void
    {
        $this->dbUser = $dbUser;
    }

    /**
     * @return string
     */
    public function getDbHost(): string
    {
        return $this->dbHost;
    }

    /**
     * @param string $dbHost
     */
    private function setDbHost(string $dbHost): void
    {
        $this->dbHost = $dbHost;
    }

    /**
     * @return string
     */
    public function getDbDatabase(): string
    {
        return $this->dbDatabase;
    }

    /**
     * @param string $dbDatabase
     */
    private function setDbDatabase(string $dbDatabase): void
    {
        $this->dbDatabase = $dbDatabase;
    }

    /**
     * @param array $params
     * @return static
     */
    public static function setParams(array $params): self {
        $selfObj = new self();

        $selfObj->setDbHost($params['database']['host']);
        $selfObj->setDbPass($params['database']['password']);
        $selfObj->setDbUser($params['database']['user']);
        $selfObj->setDbDatabase($params['database']['database']);
        $selfObj->setDeliveryAddress($params['delivery_address']);

        return $selfObj;
    }
}