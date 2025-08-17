<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer bool typing
 * @return Bool
 */

final class SetEncryptedTyping extends Instance {
	public function request(object $peer,bool $typing) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x791451ed);
		$writer->write($peer->read());
		$writer->tgwriteBool($typing);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>