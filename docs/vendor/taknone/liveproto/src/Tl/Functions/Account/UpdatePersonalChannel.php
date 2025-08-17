<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel
 * @return Bool
 */

final class UpdatePersonalChannel extends Instance {
	public function request(object $channel) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd94305e0);
		$writer->write($channel->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>