<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id inputuser user_id
 * @return messages.HighScores
 */

final class GetGameHighScores extends Instance {
	public function request(object $peer,int $id,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe822649d);
		$writer->write($peer->read());
		$writer->writeInt($id);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>