<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count
 * @return messages.Dialogs
 */

final class DialogsNotModified extends Instance {
	public function request(int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf0e3e596);
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>