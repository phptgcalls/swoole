<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int filter_id
 * @return InputChatlist
 */

final class InputChatlistDialogFilter extends Instance {
	public function request(int $filter_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf3e0da33);
		$writer->writeInt($filter_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['filter_id'] = $reader->readInt();
		return new self($result);
	}
}

?>