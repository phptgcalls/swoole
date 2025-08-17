<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> msg_id
 * @return Vector<FactCheck>
 */

final class GetFactCheck extends Instance {
	public function request(object $peer,array $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb9cdc5ee);
		$writer->write($peer->read());
		$writer->tgwriteVector($msg_id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>