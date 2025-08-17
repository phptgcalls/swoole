<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string emoticon
 * @return Updates
 */

final class SetChatTheme extends Instance {
	public function request(object $peer,string $emoticon) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe63be13f);
		$writer->write($peer->read());
		$writer->tgwriteBytes($emoticon);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>