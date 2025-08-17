<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int pts_count int offset Vector<int> messages
 * @return messages.AffectedFoundMessages
 */

final class AffectedFoundMessages extends Instance {
	public function request(int $pts,int $pts_count,int $offset,array $messages) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xef8d3e6c);
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		$writer->writeInt($offset);
		$writer->tgwriteVector($messages,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		$result['offset'] = $reader->readInt();
		$result['messages'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>