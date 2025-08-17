<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotinlinemessageid id inputuser user_id
 * @return messages.HighScores
 */

final class GetInlineGameHighScores extends Instance {
	public function request(object $id,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf635e1b);
		$writer->write($id->read());
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