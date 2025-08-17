<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int boosts
 * @return MessageAction
 */

final class MessageActionBoostApply extends Instance {
	public function request(int $boosts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc02aa6d);
		$writer->writeInt($boosts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['boosts'] = $reader->readInt();
		return new self($result);
	}
}

?>