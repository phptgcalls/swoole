<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbusinesschatlink link
 * @return BusinessChatLink
 */

final class CreateBusinessChatLink extends Instance {
	public function request(object $link) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8851e68e);
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