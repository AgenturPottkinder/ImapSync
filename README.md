# ImapSync

This script calls imapsync per mailbox in given intervals. This way you are able to move mailboxes without fear from one customer server to another without email loss.

If you encounter problems or have questions please contact me.

## Configuration

Create one file per customer in ./Configuration. It is not important how it is named, but it should be PHP files and it should have an array like this in it:

```
<?php


$oldHost = 'server1.mydomain.com';
$newHost = 'server2.mydomain.com';

$return = [
			[
				'oldUser' => 'my@email.com',
				'oldPassword' => 'myPassword',
				'newUser' => 'myNew@email.com',
                'newPassword' => 'myNewPassword',
				'oldHost' => $oldHost,
				'newHost' => $newHost
			],
			[
				'oldUser' => 'anotherCustomerEmail@email.com',
				'oldPassword' => 'hisPassword',
				'oldHost' => $oldHost,
				'newHost' => $newHost
			],
];
```

As you can see you are able to leave some informations empty ( newUser, newPassword and also newHost ) those will be replaced by the old values.

## Requirements

All you need to do is install imapsync ( https://github.com/imapsync/imapsync ) to a path inside your $PATH variable.

### OSX

Install imapsync for example with homebrew: 

```brew install imapsync```

### Windows

To be honest I have no idea how to install it here as I am not using Windows...

### Linux ( Debian )

Just install imapsync from scratch:

```
git clone https://github.com/imapsync/imapsync imapsync
apt-get install perl libmail-imapclient-perl libterm-readkey-perl libio-socket-ssl-perl libdigest-hmac-perl liburi-perl libfile-copy-recursive-perl libio-tee-perl libunicode-string-perl
```

*Source: http://www.rootathome.de/imap-migration-mit-imapsync-unter-debian/*

Now it would make sense to add a shell script to some of your basic PATH directories like `/bin/`. Remember to have to user rights for all of there correctly.

```
echo "`pwd`/imapsync/imapsync" > /bin/imapsync
chmod +x /bin/imapsync
```

## Composer

To run this script you need to run ```composer install``` at least once to create a new autoload.php. You are able to get composer here: https://getcomposer.org

## Run this

If everything is set up just start ./run.php and you should get output.

## Contact Informations

Created by Bastian Bringenberg for Agency Pottkinder UG Germany. Contact me at [bastian@agentur-pottkinder.de](mailto:bastian@agentur-pottkinder.de).