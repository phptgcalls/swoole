<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string offset int limit true gifts
 * @return premium.BoostsList
 */

final class GetBoostsList extends Instance {
	public function request(object $peer,string $offset,int $limit,? true $gifts = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x60f67660);
		$flags = 0;
		$flags |= is_null($gifts) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
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