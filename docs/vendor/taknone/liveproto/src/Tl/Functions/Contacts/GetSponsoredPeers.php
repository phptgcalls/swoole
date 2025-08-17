<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q
 * @return contacts.SponsoredPeers
 */

final class GetSponsoredPeers extends Instance {
	public function request(string $q) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6c8c393);
		$writer->tgwriteBytes($q);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>