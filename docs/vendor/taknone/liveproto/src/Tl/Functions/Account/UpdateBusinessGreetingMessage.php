<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbusinessgreetingmessage message
 * @return Bool
 */

final class UpdateBusinessGreetingMessage extends Instance {
	public function request(? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x66cdafc4);
		$flags = 0;
		$flags |= is_null($message) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($message) === false):
			$writer->write($message->read());
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