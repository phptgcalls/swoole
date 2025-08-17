<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long phone_call_id bytes data
 * @return Update
 */

final class UpdatePhoneCallSignalingData extends Instance {
	public function request(int $phone_call_id,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2661bf09);
		$writer->writeLong($phone_call_id);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_call_id'] = $reader->readLong();
		$result['data'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>