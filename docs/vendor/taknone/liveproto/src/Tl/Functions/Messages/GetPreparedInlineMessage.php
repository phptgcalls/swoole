<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string id
 * @return messages.PreparedInlineMessage
 */

final class GetPreparedInlineMessage extends Instance {
	public function request(object $bot,string $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x857ebdb8);
		$writer->write($bot->read());
		$writer->tgwriteBytes($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>