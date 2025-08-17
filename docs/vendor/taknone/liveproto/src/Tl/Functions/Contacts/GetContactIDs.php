<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash
 * @return Vector<int>
 */

final class GetContactIDs extends Instance {
	public function request(int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7adc669d);
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