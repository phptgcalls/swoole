<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputpeer send_as
 * @return Bool
 */

final class SaveDefaultSendAs extends Instance {
	public function request(object $peer,object $send_as) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xccfddf96);
		$writer->write($peer->read());
		$writer->write($send_as->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>