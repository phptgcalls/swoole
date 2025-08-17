<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count
 * @return messages.FeaturedStickers
 */

final class FeaturedStickersNotModified extends Instance {
	public function request(int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc6dc0c66);
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