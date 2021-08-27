<?php

namespace PiwikPRO;

use Exception;
use ImporterStub\ImporterInterface;
use PiwikPRO\ReadHandlers\CsvHandler;
use PiwikPRO\ReadHandlers\HandlerInterface;
use PiwikPRO\ReadHandlers\XmlHandler;
use PiwikPRO\WriteHandlers\Database;
use PiwikPRO\WriteHandlers\Email;
use Psr\Log\LoggerInterface;
use SplFileInfo;
use UserStub\User;

class Application implements ImporterInterface
{
    /**
     * Extension of csv file
     */
    private const CSV_FILE = 'csv';

    /**
     * Extension of xml file
     */
    private const XML_FILE = 'xml';

    /**
     * Database destination type
     */
    private const DATABASE = 'database';

    /**
     * Email destination type
     */
    private const EMAIL = 'email';

    /**
     * @var User[]
     */
    private array $importedData = [];

    /**
     * @var ApplicationParams
     */
    private ApplicationParams $appParams;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * Application constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->appParams = ApplicationParams::getFilledObject($params);
    }

    /**
     * @param string $sourceType
     * @param SplFileInfo $file
     * @return array
     * @throws Exception
     */
    public function read(string $sourceType, SplFileInfo $file): array
    {
        $this->validateFile($file);

        $handler = $this->getReadHandler($sourceType);

        $this->importedData = $handler->handleRead($file);
        $this->logData();

        return $this->importedData;
    }

    /**
     * @param SplFileInfo $file
     * @throws Exception
     */
    private function validateFile(SplFileInfo $file) {
        if (!$file->isFile()) {
            throw new Exception('file does not exist!');
        }
    }

    /**
     * @param string $destinationType
     * @return array
     * @throws Exception
     */
    public function write(string $destinationType): array
    {
        switch ($destinationType) {
            case self::DATABASE:
                $db = new Database(
                    $this->appParams->getDbHost(),
                    $this->appParams->getDbDatabase(),
                    $this->appParams->getDbUser(),
                    $this->appParams->getDbPass()
                );
                return $db->saveToDatabase($this->importedData);
            case self::EMAIL:
                $email = new Email();
                return $email->send($this->importedData);
            default:
                throw new Exception('write operation not implemented');
        }
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Logging imported data if logger was set
     */
    private function logData() {
        if (isset($this->logger)) {
            foreach ($this->importedData as $user) {
                /**
                 * @var User $user
                 */
                $this->logger->debug('Imported: ' . $user->getUsername());
            }
        }
    }

    /**
     * Returns handler to read from particular source type
     *
     * @param string $sourceType
     * @return HandlerInterface
     * @throws Exception
     */
    private function getReadHandler(string $sourceType): HandlerInterface {
        switch ($sourceType) {
            case self::CSV_FILE:
                return new CsvHandler();
            case self::XML_FILE:
                return new XmlHandler();
            default:
                throw new Exception('source type not implemented');
        }
    }
}
