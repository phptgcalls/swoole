<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id true game bytes data inputcheckpasswordsrp password
 * @return messages.BotCallbackAnswer
 */

final class GetBotCallbackAnswer extends Instance {
	public function request(object $peer,int $msg_id,? true $game = null,? string $data = null,? object $password = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9342ca07);
		$flags = 0;
		$flags |= is_null($game) ? 0 : (1 << 1);
		$flags |= is_null($data) ? 0 : (1 << 0);
		$flags |= is_null($password) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		if(is_null($data) === false):
			$writer->tgwriteBytes($data);
		endif;
		if(is_null($password) === false):
			$writer->write($password->read());
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