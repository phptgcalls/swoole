<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo
 * @return MessageMedia
 */

final class MessageMediaGeo extends Instance {
	public function request(object $geo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56e0d474);
		$writer->write($geo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>