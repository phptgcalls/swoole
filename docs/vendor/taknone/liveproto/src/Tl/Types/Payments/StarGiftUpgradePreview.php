<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<StarGiftAttribute> sample_attributes
 * @return payments.StarGiftUpgradePreview
 */

final class StarGiftUpgradePreview extends Instance {
	public function request(array $sample_attributes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x167bd90b);
		$writer->tgwriteVector($sample_attributes,'StarGiftAttribute');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['sample_attributes'] = $reader->tgreadVector('StarGiftAttribute');
		return new self($result);
	}
}

?>