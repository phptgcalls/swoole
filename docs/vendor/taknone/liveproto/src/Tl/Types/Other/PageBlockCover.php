<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param pageblock cover
 * @return PageBlock
 */

final class PageBlockCover extends Instance {
	public function request(object $cover) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x39f23300);
		$writer->write($cover->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['cover'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>