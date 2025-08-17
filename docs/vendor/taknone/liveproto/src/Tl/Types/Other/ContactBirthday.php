<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long contact_id birthday birthday
 * @return ContactBirthday
 */

final class ContactBirthday extends Instance {
	public function request(int $contact_id,object $birthday) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1d998733);
		$writer->writeLong($contact_id);
		$writer->write($birthday->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['contact_id'] = $reader->readLong();
		$result['birthday'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>