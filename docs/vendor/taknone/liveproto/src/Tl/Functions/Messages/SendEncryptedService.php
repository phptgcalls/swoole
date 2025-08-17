<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer long random_id bytes data
 * @return messages.SentEncryptedMessage
 */

final class SendEncryptedService extends Instance {
	public function request(object $peer,int $random_id,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x32d439a4);
		$writer->write($peer->read());
		$writer->writeLong($random_id);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>