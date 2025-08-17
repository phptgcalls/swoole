<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<string> order
 * @return Bool
 */

final class ReorderUsernames extends Instance {
	public function request(object $channel,array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb45ced1d);
		$writer->write($channel->read());
		$writer->tgwriteVector($order,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>