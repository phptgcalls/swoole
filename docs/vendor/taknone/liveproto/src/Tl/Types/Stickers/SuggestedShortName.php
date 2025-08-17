<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string short_name
 * @return stickers.SuggestedShortName
 */

final class SuggestedShortName extends Instance {
	public function request(string $short_name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x85fea03f);
		$writer->tgwriteBytes($short_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['short_name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>