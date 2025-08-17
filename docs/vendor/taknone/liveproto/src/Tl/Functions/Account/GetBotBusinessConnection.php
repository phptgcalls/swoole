<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string connection_id
 * @return Updates
 */

final class GetBotBusinessConnection extends Instance {
	public function request(string $connection_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x76a86270);
		$writer->tgwriteBytes($connection_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>