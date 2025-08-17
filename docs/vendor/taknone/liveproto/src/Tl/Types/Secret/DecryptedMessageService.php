<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long random_id decryptedmessageaction action
 * @return secret.DecryptedMessage
 */

final class DecryptedMessageService extends Instance {
	public function request(int $random_id,object $action) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x73164160);
		$writer->writeLong($random_id);
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['random_id'] = $reader->readLong();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>