<?php

namespace CronModule;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public $correctConfig = array(
        'phpPath' => 'php',
        'scriptPath' => '/var/www/application/public/',
        'jobs' => array(
            array(
                'command' => 'index.php application cron mail',
                'schedule' => '*/5 * * * *'
            )
        ),

        // timeout in seconds for the process, defaults to 600 seconds
        'timeout' => 850
    );

    public function testCanCreate()
    {
        $this->assertInstanceOf(Configuration::class, new Configuration($this->correctConfig));
    }

    /**
     * @expectedException \CronModule\Exception\InvalidArgumentException
     */
    public function testThrowsErrorWhenNotArrayOrTraversable()
    {
        new Configuration();
        new Configuration('string');
    }

    /**
     * @expectedException \CronModule\Exception\BadMethodCallException
     */
    public function testThrowsErrorWhenConfigurationKeyDoesNotExist()
    {
        new Configuration(array(
            'wrongKey' => 'noValue'
        ));
    }

    public function testGetAndSetJobs()
    {
        $configuration = new Configuration();
        $configuration->setJobs($this->correctConfig['jobs']);
        $this->assertEquals($this->correctConfig['jobs'], $configuration->getJobs());
    }

    public function testSetAndGetJob()
    {
        $configuration = new Configuration();
        $job = $this->correctConfig['jobs'][0];
        $key = 'testJob';

        $configuration->setJob($key, $job);
        $this->assertEquals($job, $configuration->getJob($key));
    }

    public function testSetAndGetPhpPath()
    {
        $configuration = new Configuration();
        $phpPath = $this->correctConfig['phpPath'];

        $configuration->setPhpPath($phpPath);
        $this->assertEquals($phpPath, $configuration->getPhpPath());
    }

    public function testSetAndGetScriptPath()
    {
        $configuration = new Configuration();
        $scriptPath = $this->correctConfig['scriptPath'];

        $configuration->setScriptPath($scriptPath);
        $this->assertEquals($scriptPath, $configuration->getScriptPath());
    }

    public function testSetAndGetTimeout()
    {
        $configuration = new Configuration();
        $timeout = $this->correctConfig['timeout'];

        $configuration->setTimeout($timeout);
        $this->assertEquals($timeout, $configuration->getTimeout());
    }
} 