<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel bool restricted
 * @return Updates
 */

final class RestrictSponsoredMessages extends Instance {
	public function request(object $channel,bool $restricted) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9ae91519);
		$writer->write($channel->read());
		$writer->tgwriteBool($restricted);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>