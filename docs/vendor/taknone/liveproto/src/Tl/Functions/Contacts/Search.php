<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q int limit
 * @return contacts.Found
 */

final class Search extends Instance {
	public function request(string $q,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x11f812d8);
		$writer->tgwriteBytes($q);
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