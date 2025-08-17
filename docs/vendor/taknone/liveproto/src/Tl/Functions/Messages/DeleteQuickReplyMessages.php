<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id Vector<int> id
 * @return Updates
 */

final class DeleteQuickReplyMessages extends Instance {
	public function request(int $shortcut_id,array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe105e910);
		$writer->writeInt($shortcut_id);
		$writer->tgwriteVector($id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>