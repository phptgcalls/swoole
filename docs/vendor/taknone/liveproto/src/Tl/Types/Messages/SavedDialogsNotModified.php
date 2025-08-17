<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count
 * @return messages.SavedDialogs
 */

final class SavedDialogsNotModified extends Instance {
	public function request(int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc01f6fe8);
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