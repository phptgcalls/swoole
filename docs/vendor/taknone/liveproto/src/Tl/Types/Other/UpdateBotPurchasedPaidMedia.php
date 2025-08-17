<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id string payload int qts
 * @return Update
 */

final class UpdateBotPurchasedPaidMedia extends Instance {
	public function request(int $user_id,string $payload,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x283bd312);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($payload);
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['payload'] = $reader->tgreadBytes();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>