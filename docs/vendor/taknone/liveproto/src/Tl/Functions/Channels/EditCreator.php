<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputuser user_id inputcheckpasswordsrp password
 * @return Updates
 */

final class EditCreator extends Instance {
	public function request(object $channel,object $user_id,object $password) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8f38cd1f);
		$writer->write($channel->read());
		$writer->write($user_id->read());
		$writer->write($password->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>