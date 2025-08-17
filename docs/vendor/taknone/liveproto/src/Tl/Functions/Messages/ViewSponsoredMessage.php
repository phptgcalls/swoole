<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_id
 * @return Bool
 */

final class ViewSponsoredMessage extends Instance {
	public function request(string $random_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x269e3643);
		$writer->tgwriteBytes($random_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>