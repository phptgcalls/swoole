<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string name int utc_offset
 * @return Timezone
 */

final class Timezone extends Instance {
	public function request(string $id,string $name,int $utc_offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xff9289f5);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($name);
		$writer->writeInt($utc_offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['name'] = $reader->tgreadBytes();
		$result['utc_offset'] = $reader->readInt();
		return new self($result);
	}
}

?>