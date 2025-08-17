<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string about
 * @return Bool
 */

final class EditChatAbout extends Instance {
	public function request(object $peer,string $about) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdef60797);
		$writer->write($peer->read());
		$writer->tgwriteBytes($about);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>