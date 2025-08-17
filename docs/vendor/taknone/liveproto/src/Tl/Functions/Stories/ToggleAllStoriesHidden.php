<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool hidden
 * @return Bool
 */

final class ToggleAllStoriesHidden extends Instance {
	public function request(bool $hidden) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7c2557c4);
		$writer->tgwriteBool($hidden);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>