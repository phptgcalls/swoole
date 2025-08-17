<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<string> order
 * @return Bool
 */

final class ReorderUsernames extends Instance {
	public function request(array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xef500eab);
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