<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputContact> contacts
 * @return contacts.ImportedContacts
 */

final class ImportContacts extends Instance {
	public function request(array $contacts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2c800be5);
		$writer->tgwriteVector($contacts,'InputContact');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>