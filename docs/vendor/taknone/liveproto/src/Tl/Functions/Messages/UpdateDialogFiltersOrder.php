<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> order
 * @return Bool
 */

final class UpdateDialogFiltersOrder extends Instance {
	public function request(array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc563c1e4);
		$writer->tgwriteVector($order,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>