<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id true refund
 * @return InputStarsTransaction
 */

final class InputStarsTransaction extends Instance {
	public function request(string $id,? true $refund = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x206ae6d1);
		$flags = 0;
		$flags |= is_null($refund) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['refund'] = true;
		else:
			$result['refund'] = false;
		endif;
		$result['id'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>