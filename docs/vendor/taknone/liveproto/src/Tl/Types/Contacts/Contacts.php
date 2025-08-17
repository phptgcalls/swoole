<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Contact> contacts int saved_count Vector<User> users
 * @return contacts.Contacts
 */

final class Contacts extends Instance {
	public function request(array $contacts,int $saved_count,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeae87e42);
		$writer->tgwriteVector($contacts,'Contact');
		$writer->writeInt($saved_count);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['contacts'] = $reader->tgreadVector('Contact');
		$result['saved_count'] = $reader->readInt();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>