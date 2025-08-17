<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id string charge_id
 * @return Updates
 */

final class RefundStarsCharge extends Instance {
	public function request(object $user_id,string $charge_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x25ae8f4a);
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