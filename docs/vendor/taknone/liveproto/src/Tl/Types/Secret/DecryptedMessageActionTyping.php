<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param sendmessageaction action
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionTyping extends Instance {
	public function request(object $action) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xccb27641);
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>