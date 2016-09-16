<?php

namespace Pottkinder\ImapSync\Service;

use Pottkinder\ImapSync\Domain\Model\Mailbox;

class SyncService
{
    /**
     * function sync
     * sync all mails for this mailbox queue.
     *
     * @param Mailbox $mailbox
     */
    public function sync(Mailbox $mailbox)
    {
        //TODO: remove dry
        $command = InstallService::getInstance()->getBinaryPath().' --dry --host1 "'.$mailbox->getOldHost().'" --host2 "'.$mailbox->getNewHost().'" --user1 "'.$mailbox->getOldUser().'" --user2 "'.$mailbox->getNewUser().'" --password1 "'.$mailbox->getOldPassword().'" --password2 "'.$mailbox->getNewPassword().'" --logdir "'.__DIR__.'/../../temporary/'.'" --logfile "'.$mailbox->getNewUser().'"';
        LogService::log(getmypid(), $command);
        echo exec($command);
    }
}
