<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long gift_id
 * @return payments.StarGiftUpgradePreview
 */

final class GetStarGiftUpgradePreview extends Instance {
	public function request(int $gift_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9c9abcb1);
		$writer->writeLong($gift_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>