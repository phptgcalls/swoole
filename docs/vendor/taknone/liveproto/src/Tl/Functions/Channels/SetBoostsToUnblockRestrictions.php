<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int boosts
 * @return Updates
 */

final class SetBoostsToUnblockRestrictions extends Instance {
	public function request(object $channel,int $boosts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad399cee);
		$writer->write($channel->read());
		$writer->writeInt($boosts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>