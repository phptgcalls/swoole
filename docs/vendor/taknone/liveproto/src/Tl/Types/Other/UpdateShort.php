<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param update update int date
 * @return Updates
 */

final class UpdateShort extends Instance {
	public function request(object $update,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x78d4dec1);
		$writer->write($update->read());
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['update'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>