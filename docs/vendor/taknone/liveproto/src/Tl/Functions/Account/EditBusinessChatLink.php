<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug inputbusinesschatlink link
 * @return BusinessChatLink
 */

final class EditBusinessChatLink extends Instance {
	public function request(string $slug,object $link) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c3410af);
		$writer->tgwriteBytes($slug);
		$writer->write($link->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>