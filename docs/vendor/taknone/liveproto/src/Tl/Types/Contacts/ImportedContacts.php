<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ImportedContact> imported Vector<PopularContact> popular_invites Vector<long> retry_contacts Vector<User> users
 * @return contacts.ImportedContacts
 */

final class ImportedContacts extends Instance {
	public function request(array $imported,array $popular_invites,array $retry_contacts,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77d01c3b);
		$writer->tgwriteVector($imported,'ImportedContact');
		$writer->tgwriteVector($popular_invites,'PopularContact');
		$writer->tgwriteVector($retry_contacts,'long');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['imported'] = $reader->tgreadVector('ImportedContact');
		$result['popular_invites'] = $reader->tgreadVector('PopularContact');
		$result['retry_contacts'] = $reader->tgreadVector('long');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>