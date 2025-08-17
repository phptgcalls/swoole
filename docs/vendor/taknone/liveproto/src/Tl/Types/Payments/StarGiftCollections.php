<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<StarGiftCollection> collections
 * @return payments.StarGiftCollections
 */

final class StarGiftCollections extends Instance {
	public function request(array $collections) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a2932f3);
		$writer->tgwriteVector($collections,'StarGiftCollection');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['collections'] = $reader->tgreadVector('StarGiftCollection');
		return new self($result);
	}
}

?>