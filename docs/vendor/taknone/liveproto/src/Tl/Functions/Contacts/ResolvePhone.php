<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone
 * @return contacts.ResolvedPeer
 */

final class ResolvePhone extends Instance {
	public function request(string $phone) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8af94344);
		$writer->tgwriteBytes($phone);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>