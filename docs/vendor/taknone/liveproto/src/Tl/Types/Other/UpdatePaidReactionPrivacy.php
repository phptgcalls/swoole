<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param paidreactionprivacy private
 * @return Update
 */

final class UpdatePaidReactionPrivacy extends Instance {
	public function request(object $private) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8b725fce);
		$writer->write($private->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['private'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>