<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<int> id
 * @return messages.AffectedMessages
 */

final class DeleteMessages extends Instance {
	public function request(object $channel,array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84c1fd4e);
		$writer->write($channel->read());
		$writer->tgwriteVector($id,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>