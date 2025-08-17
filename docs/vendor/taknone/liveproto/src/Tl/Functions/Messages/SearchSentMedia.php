<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q messagesfilter filter int limit
 * @return messages.Messages
 */

final class SearchSentMedia extends Instance {
	public function request(string $q,object $filter,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x107e31a0);
		$writer->tgwriteBytes($q);
		$writer->write($filter->read());
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