<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates long query_id string result_id
 * @return MediaArea
 */

final class InputMediaAreaVenue extends Instance {
	public function request(object $coordinates,int $query_id,string $result_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb282217f);
		$writer->write($coordinates->read());
		$writer->writeLong($query_id);
		$writer->tgwriteBytes($result_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['query_id'] = $reader->readLong();
		$result['result_id'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>