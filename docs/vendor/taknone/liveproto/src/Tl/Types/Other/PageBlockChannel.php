<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chat channel
 * @return PageBlock
 */

final class PageBlockChannel extends Instance {
	public function request(object $channel) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xef1751b5);
		$writer->write($channel->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>