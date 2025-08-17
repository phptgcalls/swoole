<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length true collapsed
 * @return MessageEntity
 */

final class MessageEntityBlockquote extends Instance {
	public function request(int $offset,int $length,? true $collapsed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf1ccaaac);
		$flags = 0;
		$flags |= is_null($collapsed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['collapsed'] = true;
		else:
			$result['collapsed'] = false;
		endif;
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>