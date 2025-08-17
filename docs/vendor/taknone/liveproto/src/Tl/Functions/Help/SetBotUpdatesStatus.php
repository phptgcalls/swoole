<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pending_updates_count string message
 * @return Bool
 */

final class SetBotUpdatesStatus extends Instance {
	public function request(int $pending_updates_count,string $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xec22cfcd);
		$writer->writeInt($pending_updates_count);
		$writer->tgwriteBytes($message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>