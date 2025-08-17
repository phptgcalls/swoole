<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int msg_id string offset int limit
 * @return stats.PublicForwards
 */

final class GetMessagePublicForwards extends Instance {
	public function request(object $channel,int $msg_id,string $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5f150144);
		$writer->write($channel->read());
		$writer->writeInt($msg_id);
		$writer->tgwriteBytes($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>