<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id Vector<int> completed Vector<int> incompleted
 * @return Updates
 */

final class ToggleTodoCompleted extends Instance {
	public function request(object $peer,int $msg_id,array $completed,array $incompleted) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd3e03124);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->tgwriteVector($completed,'int');
		$writer->tgwriteVector($incompleted,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>