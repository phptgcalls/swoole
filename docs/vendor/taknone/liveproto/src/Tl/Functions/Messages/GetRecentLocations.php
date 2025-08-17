<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int limit long hash
 * @return messages.Messages
 */

final class GetRecentLocations extends Instance {
	public function request(object $peer,int $limit,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x702a40e0);
		$writer->write($peer->read());
		$writer->writeInt($limit);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>