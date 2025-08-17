<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id long user_id bytes payload postaddress shipping_address
 * @return Update
 */

final class UpdateBotShippingQuery extends Instance {
	public function request(int $query_id,int $user_id,string $payload,object $shipping_address) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb5aefd7d);
		$writer->writeLong($query_id);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($payload);
		$writer->write($shipping_address->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['query_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['payload'] = $reader->tgreadBytes();
		$result['shipping_address'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>