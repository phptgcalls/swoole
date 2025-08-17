<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param starsamount price
 * @return MessageAction
 */

final class MessageActionSuggestedPostSuccess extends Instance {
	public function request(object $price) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x95ddcf69);
		$writer->write($price->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['price'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>