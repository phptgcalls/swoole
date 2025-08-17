<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date
 * @return messages.SentEncryptedMessage
 */

final class SentEncryptedMessage extends Instance {
	public function request(int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x560f8935);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>