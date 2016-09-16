#!/usr/bin/env php
<?php
set_time_limit(0);
date_default_timezone_set('Europe/Berlin');
require_once __DIR__.'/vendor/autoload.php';

class Runner
{
    protected $working = true;

    /**
     * @var array
     */
    protected $mailboxes = [];

    public function start()
    {
        //pcntl_signal(SIGTERM, array(&$this, 'stop'));
        \Pottkinder\ImapSync\Service\InstallService::getInstance()->ensureInstallation();
        $this->mailboxes = \Pottkinder\ImapSync\Service\ConfigurationService::getInstance()->getConfiguration();
        $this->run();
    }

    public function run()
    {
        while ($this->working) {
            $task = $this->getTask();
            if ($task !== null) {
                $tmp = new \Pottkinder\ImapSync\Worker\Thread($task);
                $tmp->start();
            } else {
                \Pottkinder\ImapSync\Service\LogService::log(getmypid(), 'No jobs found.');
            }
            sleep(30);
        }
    }

    public function stop()
    {
        $this->working = false;
    }

    protected function getTask()
    {
        /**
         * @var \Pottkinder\ImapSync\Model\Mailbox
         */
        foreach ($this->mailboxes as $mailbox) {
            if ($mailbox->shouldRun()) {
                return $mailbox;
            }
        }

        return null;
    }
}

$runner = new Runner();
$runner->start();
