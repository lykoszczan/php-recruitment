<?php

use ImporterStub\ImporterInterface;
use PHPUnit\Framework\TestCase;
use PiwikPRO\Application;
use Psr\Log\LoggerInterface;
use UserStub\User;

class ApplicationTest extends TestCase
{
    protected ImporterInterface $app;

    protected function setUp(): void
    {
        $this->app = new Application([
            'database' => array(
                'host' => 'localhost',
                'database' => 'database',
                'user' => 'user',
                'password' => 'password'
            ),
            "delivery_address" => "admin@example.com"
        ]);
    }

    /*********************************
     *  DO NOT CHANGE TEST BELOW
     ********************************/

    public function testItShouldReadFromCsv(): void
    {
        $users = $this->app->read('csv', $this->prepareFile('users.csv'));

        $this->assertTrue($this->containUser(new User('user1', 'user1@example.com'), $users));
        $this->assertTrue($this->containUser(new User('user2', 'user2@example.com'), $users));
    }

    public function testItShouldReadFromXml(): void
    {
        $users = $this->app->read('xml', $this->prepareFile('users.xml'));

        $this->assertTrue($this->containUser(new User('user3', 'user3@example.com'), $users));
        $this->assertTrue($this->containUser(new User('user4', 'user4@example.com'), $users));
    }

    public function testItShouldThrowExceptionIfFileDoesNotExist(): void
    {
        $this->expectException(\Exception::class);

        $this->app->read('xml', $this->prepareFile('this_file_do_not_exist.xml'));
    }

    public function testItShouldImportFromCsvAndSaveToDatabase(): void
    {
        $this->app->read('csv', $this->prepareFile('users.csv'));

        $this->assertSame(
            [
                'User with email: user1@example.com added to database',
                'User with email: user2@example.com added to database'
            ],
            $this->app->write('database')
        );
    }

    public function testItShouldImportFromXmlAndSendEmail(): void
    {
        $this->app->read('xml', $this->prepareFile('users.xml'));

        $this->assertSame(
            [
                'Email sent to: user3@example.com',
                'Email sent to: user4@example.com'
            ],
            $this->app->write('email')
        );
    }

    public function testItShouldImportFromXmlAndLogMessage(): void
    {
        $logger = $this->prophesize(LoggerInterface::class);

        $logger->debug("Imported: user3")->shouldBeCalled();
        $logger->debug("Imported: user4")->shouldBeCalled();

        $this->app->setLogger($logger->reveal());

        $this->app->read('xml', $this->prepareFile('users.xml'));
        $this->app->write('email');
    }

    protected function prepareFile(string $fileName): SplFileInfo
    {
        return new \SplFileInfo(__DIR__.'/fixtures/'.$fileName);
    }

    protected function containUser(User $expectedUser, array $users) : bool
    {
        foreach ($users as $user) {
            if ($expectedUser->equals($user)) {
                return true;
            }
        }

        return false;
    }
}
