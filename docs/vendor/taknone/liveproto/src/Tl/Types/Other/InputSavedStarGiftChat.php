<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long saved_id
 * @return InputSavedStarGift
 */

final class InputSavedStarGiftChat extends Instance {
	public function request(object $peer,int $saved_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf101aa7f);
		$writer->write($peer->read());
		$writer->writeLong($saved_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['saved_id'] = $reader->readLong();
		return new self($result);
	}
}

?>