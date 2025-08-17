<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string offset int limit true order_by_revenue true order_by_date
 * @return payments.SuggestedStarRefBots
 */

final class GetSuggestedStarRefBots extends Instance {
	public function request(object $peer,string $offset,int $limit,? true $order_by_revenue = null,? true $order_by_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd6b48f7);
		$flags = 0;
		$flags |= is_null($order_by_revenue) ? 0 : (1 << 0);
		$flags |= is_null($order_by_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>