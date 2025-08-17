<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer int max_date
 * @return Bool
 */

final class ReadEncryptedHistory extends Instance {
	public function request(object $peer,int $max_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f4b690a);
		$writer->write($peer->read());
		$writer->writeInt($max_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>