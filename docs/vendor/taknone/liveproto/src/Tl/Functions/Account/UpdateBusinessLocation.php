<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point string address
 * @return Bool
 */

final class UpdateBusinessLocation extends Instance {
	public function request(? object $geo_point = null,? string $address = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9e6b131a);
		$flags = 0;
		$flags |= is_null($geo_point) ? 0 : (1 << 1);
		$flags |= is_null($address) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($geo_point) === false):
			$writer->write($geo_point->read());
		endif;
		if(is_null($address) === false):
			$writer->tgwriteBytes($address);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>