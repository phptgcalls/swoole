<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug
 * @return Updates
 */

final class ApplyGiftCode extends Instance {
	public function request(string $slug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf6e26854);
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