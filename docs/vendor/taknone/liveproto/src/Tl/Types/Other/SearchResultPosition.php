<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int msg_id int date int offset
 * @return SearchResultsPosition
 */

final class SearchResultPosition extends Instance {
	public function request(int $msg_id,int $date,int $offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f648b67);
		$writer->writeInt($msg_id);
		$writer->writeInt($date);
		$writer->writeInt($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['offset'] = $reader->readInt();
		return new self($result);
	}
}

?>