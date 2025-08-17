<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title
 * @return stickers.SuggestedShortName
 */

final class SuggestShortName extends Instance {
	public function request(string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4dafc503);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>