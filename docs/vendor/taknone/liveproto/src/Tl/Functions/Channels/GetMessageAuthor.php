<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int id
 * @return User
 */

final class GetMessageAuthor extends Instance {
	public function request(object $channel,int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xece2a0e6);
		$writer->write($channel->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>