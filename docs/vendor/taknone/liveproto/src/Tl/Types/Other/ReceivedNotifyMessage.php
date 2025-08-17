<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id int flags
 * @return ReceivedNotifyMessage
 */

final class ReceivedNotifyMessage extends Instance {
	public function request(int $id,int $flags) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa384b779);
		$writer->writeInt($id);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['flags'] = $reader->readInt();
		return new self($result);
	}
}

?>