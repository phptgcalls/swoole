<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id string offset int limit
 * @return stats.PublicForwards
 */

final class GetStoryPublicForwards extends Instance {
	public function request(object $peer,int $id,string $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6437ef6);
		$writer->write($peer->read());
		$writer->writeInt($id);
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