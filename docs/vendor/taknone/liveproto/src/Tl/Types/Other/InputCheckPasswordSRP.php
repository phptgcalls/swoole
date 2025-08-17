<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long srp_id bytes A bytes M1
 * @return InputCheckPasswordSRP
 */

final class InputCheckPasswordSRP extends Instance {
	public function request(int $srp_id,string $A,string $M1) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd27ff082);
		$writer->writeLong($srp_id);
		$writer->tgwriteBytes($A);
		$writer->tgwriteBytes($M1);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['srp_id'] = $reader->readLong();
		$result['A'] = $reader->tgreadBytes();
		$result['M1'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>