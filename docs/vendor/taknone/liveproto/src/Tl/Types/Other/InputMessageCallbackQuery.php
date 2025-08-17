<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long query_id
 * @return InputMessage
 */

final class InputMessageCallbackQuery extends Instance {
	public function request(int $id,int $query_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xacfa1a7e);
		$writer->writeInt($id);
		$writer->writeLong($query_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['query_id'] = $reader->readLong();
		return new self($result);
	}
}

?>