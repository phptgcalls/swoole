<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int max_id
 * @return Update
 */

final class UpdateReadStories extends Instance {
	public function request(object $peer,int $max_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf74e932b);
		$writer->write($peer->read());
		$writer->writeInt($max_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['max_id'] = $reader->readInt();
		return new self($result);
	}
}

?>