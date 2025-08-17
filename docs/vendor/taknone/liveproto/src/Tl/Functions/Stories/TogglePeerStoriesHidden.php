<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer bool hidden
 * @return Bool
 */

final class TogglePeerStoriesHidden extends Instance {
	public function request(object $peer,bool $hidden) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbd0415c4);
		$writer->write($peer->read());
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