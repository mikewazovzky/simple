<?php

class LoggerTest extends PHPUnit_Framework_TestCase
{
	protected $logger;
	protected $filename = 'testlog.txt';

	protected function setUp()
	{
		$filename = $this->filename;
		$this->logger = new \App\Logger($filename);
		if(file_exists($filename)) {
			unlink($filename);
		}
	}

	protected function tearDown()
	{
		if(file_exists($this->filename)) {
			unlink($this->filename);
		}
	}

	/** @test */
	function it_saves_a_filename()
	{
		$this->assertEquals($this->filename, $this->logger->getFilename());
	}

	/** @test */
	function it_logs_something()
	{
		$this->logger->alert('Test Alert Message');
		$this->assertNotEmpty($this->logger->getLog());
	}	

	/** @test */
	function it_can_read_log_data()
	{
		$this->logger->info('Info: just for your information');
		$this->logger->warning('Warning: get ready!');
		$this->logger->alert('Alert: Houston, we have a problem..');
		$this->assertCount(3, $this->logger->getLog());
	}		
}