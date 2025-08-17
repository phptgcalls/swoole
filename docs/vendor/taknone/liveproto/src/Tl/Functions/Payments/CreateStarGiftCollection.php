<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string title Vector<InputSavedStarGift> stargift
 * @return StarGiftCollection
 */

final class CreateStarGiftCollection extends Instance {
	public function request(object $peer,string $title,array $stargift) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1f4a0e87);
		$writer->write($peer->read());
		$writer->tgwriteBytes($title);
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