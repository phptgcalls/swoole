<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id
 * @return messages.HistoryImport
 */

final class HistoryImport extends Instance {
	public function request(int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1662af0b);
		$writer->writeLong($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		return new self($result);
	}
}

?>