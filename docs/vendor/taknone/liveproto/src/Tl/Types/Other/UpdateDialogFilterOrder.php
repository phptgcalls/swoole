<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> order
 * @return Update
 */

final class UpdateDialogFilterOrder extends Instance {
	public function request(array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa5d72105);
		$writer->tgwriteVector($order,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['order'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>