<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Fragment;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputcollectible collectible
 * @return fragment.CollectibleInfo
 */

final class GetCollectibleInfo extends Instance {
	public function request(object $collectible) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbe1e85ba);
		$writer->write($collectible->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>