<?php

namespace Pottkinder\ImapSync\Worker;

use Pottkinder\ImapSync\Domain\Model\Mailbox;
use Pottkinder\ImapSync\Service\LogService;
use Pottkinder\ImapSync\Service\SyncService;

// TODO make threadable
class Thread
{
    /**
     * @var null|Mailbox
     */
    protected $mailbox = null;

    public function __construct(Mailbox $mailbox)
    {
        $this->mailbox = $mailbox;
    }

    public function start()
    {
        LogService::log(getmypid(), 'Starting imapSync', $this->mailbox);
        $this->mailbox->setRunning(true);
        $syncService = new SyncService();
        $syncService->sync($this->mailbox);
        LogService::log(getmypid(), 'Finished imapSync', $this->mailbox);
        $this->mailbox->setRunning(false);
        $this->mailbox->setLastRun(new \DateTime());
    }
}
