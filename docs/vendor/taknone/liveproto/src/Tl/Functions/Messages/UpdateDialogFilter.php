<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id dialogfilter filter
 * @return Bool
 */

final class UpdateDialogFilter extends Instance {
	public function request(int $id,? object $filter = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ad4a04a);
		$flags = 0;
		$flags |= is_null($filter) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		if(is_null($filter) === false):
			$writer->write($filter->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>