<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int version int random_length
 * @return messages.DhConfig
 */

final class GetDhConfig extends Instance {
	public function request(int $version,int $random_length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x26cf8950);
		$writer->writeInt($version);
		$writer->writeInt($random_length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>