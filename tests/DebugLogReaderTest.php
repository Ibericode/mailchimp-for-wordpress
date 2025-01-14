<?php

use PHPUnit\Framework\TestCase;

class DebugLogReaderTest extends TestCase
{
    /**
     * @var string
     */
    protected $file = '/tmp/mc4wp-debug.log';

    /**
     * @var string
     */
    protected array $sample_log_lines = [
        'eCommerce360 > Successfully added order 101',
        'eCommerce360 > Order 101 deleted',
    ];

    /**
     * DebugLogReaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $log = new MC4WP_Debug_Log($this->file);
        foreach ($this->sample_log_lines as $line) {
            $log->error($line);
        }
    }

    /**
     * @covers MC4WP_Debug_Log_Reader::all
     */
    public function test_all()
    {
        $reader = new MC4WP_Debug_Log_Reader($this->file);
        self::assertEquals(file_get_contents($this->file), $reader->all());
    }

    /**
     * @covers MC4WP_Debug_Log_Reader::read
     */
    public function test_read()
    {
        $reader = new MC4WP_Debug_Log_Reader($this->file);

        // first read should return first line
        self::assertStringContainsString($this->sample_log_lines[0], $reader->read());

        // read should match format
        self::assertMatchesRegularExpression('/^\[([0-9-: ]+)\] (INFO|WARNING|ERROR)\: (.*)$/', $reader->read());
    }

    /**
     * @covers MC4WP_Debug_Log_Reader::read_as_html
     */
    public function test_read_as_html()
    {
        $reader = new MC4WP_Debug_Log_Reader($this->file);
        self::assertMatchesRegularExpression('/^<span .*>\[([0-9-: ]+)\]<\/span> <span .*>(INFO|WARNING|ERROR)\:<\/span> <span .*>(.*)<\/span>$/', $reader->read_as_html());
    }
}
