<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param document document
 * @return account.SavedRingtone
 */

final class SavedRingtoneConverted extends Instance {
	public function request(object $document) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1f307eb7);
		$writer->write($document->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['document'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>