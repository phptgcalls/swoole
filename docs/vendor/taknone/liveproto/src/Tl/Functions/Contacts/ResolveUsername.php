<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string username string referer
 * @return contacts.ResolvedPeer
 */

final class ResolveUsername extends Instance {
	public function request(string $username,? string $referer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x725afbbc);
		$flags = 0;
		$flags |= is_null($referer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($username);
		if(is_null($referer) === false):
			$writer->tgwriteBytes($referer);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>