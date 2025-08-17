<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id string charge_id true restore
 * @return Bool
 */

final class BotCancelStarsSubscription extends Instance {
	public function request(object $user_id,string $charge_id,? true $restore = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6dfa0622);
		$flags = 0;
		$flags |= is_null($restore) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($user_id->read());
		$writer->tgwriteBytes($charge_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>