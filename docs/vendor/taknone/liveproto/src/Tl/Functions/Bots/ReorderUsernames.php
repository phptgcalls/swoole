<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot Vector<string> order
 * @return Bool
 */

final class ReorderUsernames extends Instance {
	public function request(object $bot,array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9709b1c2);
		$writer->write($bot->read());
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