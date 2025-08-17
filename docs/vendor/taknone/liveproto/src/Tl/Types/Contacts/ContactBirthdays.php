<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ContactBirthday> contacts Vector<User> users
 * @return contacts.ContactBirthdays
 */

final class ContactBirthdays extends Instance {
	public function request(array $contacts,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x114ff30d);
		$writer->tgwriteVector($contacts,'ContactBirthday');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['contacts'] = $reader->tgreadVector('ContactBirthday');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>