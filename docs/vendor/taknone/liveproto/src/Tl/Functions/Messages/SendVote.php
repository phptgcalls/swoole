<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id Vector<bytes> options
 * @return Updates
 */

final class SendVote extends Instance {
	public function request(object $peer,int $msg_id,array $options) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x10ea6184);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->tgwriteVector($options,'bytes');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>