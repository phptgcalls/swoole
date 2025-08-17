<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return payments.SavedInfo
 */

final class GetSavedInfo extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x227d824b);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>