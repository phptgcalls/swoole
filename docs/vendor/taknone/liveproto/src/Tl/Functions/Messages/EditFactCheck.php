<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id textwithentities text
 * @return Updates
 */

final class EditFactCheck extends Instance {
	public function request(object $peer,int $msg_id,object $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x589ee75);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->write($text->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>