<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string subscription_id
 * @return Bool
 */

final class FulfillStarsSubscription extends Instance {
	public function request(object $peer,string $subscription_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc5bebb3);
		$writer->write($peer->read());
		$writer->tgwriteBytes($subscription_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>