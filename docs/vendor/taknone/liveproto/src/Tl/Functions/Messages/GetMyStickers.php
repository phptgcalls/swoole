<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long offset_id int limit
 * @return messages.MyStickers
 */

final class GetMyStickers extends Instance {
	public function request(int $offset_id,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd0b5e1fc);
		$writer->writeLong($offset_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>