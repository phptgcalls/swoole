<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id int expire_date
 * @return messages.BotPreparedInlineMessage
 */

final class BotPreparedInlineMessage extends Instance {
	public function request(string $id,int $expire_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ecf0511);
		$writer->tgwriteBytes($id);
		$writer->writeInt($expire_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['expire_date'] = $reader->readInt();
		return new self($result);
	}
}

?>