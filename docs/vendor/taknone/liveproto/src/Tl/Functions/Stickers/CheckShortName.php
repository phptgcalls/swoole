<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string short_name
 * @return Bool
 */

final class CheckShortName extends Instance {
	public function request(string $short_name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x284b3639);
		$writer->tgwriteBytes($short_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>