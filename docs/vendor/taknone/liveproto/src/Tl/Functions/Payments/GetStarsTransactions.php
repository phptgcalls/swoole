<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string offset int limit true inbound true outbound true ascending true ton string subscription_id
 * @return payments.StarsStatus
 */

final class GetStarsTransactions extends Instance {
	public function request(object $peer,string $offset,int $limit,? true $inbound = null,? true $outbound = null,? true $ascending = null,? true $ton = null,? string $subscription_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x69da4557);
		$flags = 0;
		$flags |= is_null($inbound) ? 0 : (1 << 0);
		$flags |= is_null($outbound) ? 0 : (1 << 1);
		$flags |= is_null($ascending) ? 0 : (1 << 2);
		$flags |= is_null($ton) ? 0 : (1 << 4);
		$flags |= is_null($subscription_id) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($subscription_id) === false):
			$writer->tgwriteBytes($subscription_id);
		endif;
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