<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param messagesfilter filter int count true inexact
 * @return messages.SearchCounter
 */

final class SearchCounter extends Instance {
	public function request(object $filter,int $count,? true $inexact = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe844ebff);
		$flags = 0;
		$flags |= is_null($inexact) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($filter->read());
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['inexact'] = true;
		else:
			$result['inexact'] = false;
		endif;
		$result['filter'] = $reader->tgreadObject();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>