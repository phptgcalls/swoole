<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stargift gift
 * @return WebPageAttribute
 */

final class WebPageAttributeUniqueStarGift extends Instance {
	public function request(object $gift) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcf6f6db8);
		$writer->write($gift->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['gift'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>