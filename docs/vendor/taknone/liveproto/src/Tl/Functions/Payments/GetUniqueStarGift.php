<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug
 * @return payments.UniqueStarGift
 */

final class GetUniqueStarGift extends Instance {
	public function request(string $slug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa1974d72);
		$writer->tgwriteBytes($slug);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>