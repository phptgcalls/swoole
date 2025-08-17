<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long msg_id x query
 * @return X
 */

final class InvokeAfterMsg extends Instance {
	public function request(int $msg_id,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb9f372d);
		$writer->writeLong($msg_id);
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>