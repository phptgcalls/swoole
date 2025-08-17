<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputSavedStarGift> stargift
 * @return payments.SavedStarGifts
 */

final class GetSavedStarGift extends Instance {
	public function request(array $stargift) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb455a106);
		$writer->tgwriteVector($stargift,'InputSavedStarGift');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>