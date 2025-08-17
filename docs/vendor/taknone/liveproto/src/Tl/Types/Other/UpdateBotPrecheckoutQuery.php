<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id long user_id bytes payload string currency long total_amount paymentrequestedinfo info string shipping_option_id
 * @return Update
 */

final class UpdateBotPrecheckoutQuery extends Instance {
	public function request(int $query_id,int $user_id,string $payload,string $currency,int $total_amount,? object $info = null,? string $shipping_option_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8caa9a96);
		$flags = 0;
		$flags |= is_null($info) ? 0 : (1 << 0);
		$flags |= is_null($shipping_option_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($payload);
		if(is_null($info) === false):
			$writer->write($info->read());
		endif;
		if(is_null($shipping_option_id) === false):
			$writer->tgwriteBytes($shipping_option_id);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['query_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		$result['payload'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['info'] = $reader->tgreadObject();
		else:
			$result['info'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['shipping_option_id'] = $reader->tgreadBytes();
		else:
			$result['shipping_option_id'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		return new self($result);
	}
}

?>