<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return secret.SendMessageAction
 */

final class SendMessageRecordAudioAction extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd52f73f7);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>