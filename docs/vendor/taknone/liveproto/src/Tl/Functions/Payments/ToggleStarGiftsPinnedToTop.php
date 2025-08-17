<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<InputSavedStarGift> stargift
 * @return Bool
 */

final class ToggleStarGiftsPinnedToTop extends Instance {
	public function request(object $peer,array $stargift) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1513e7b0);
		$writer->write($peer->read());
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