<?php

namespace Pottkinder\ImapSync\Service;

use Pottkinder\ImapSync\Domain\Model\Mailbox;

class LogService
{
    public static function log($processId, $message, Mailbox $mailbox = null)
    {
        if ($mailbox === null) {
            $mailboxMessage = '';
        } else {
            $mailboxMessage = '['.$mailbox->getOldUser().']';
        }
        $now = new \DateTime();
        echo $now->format('Y-m-d H:i:s').' ['.$processId.']'.$mailboxMessage.' '.$message.PHP_EOL;
    }
}
