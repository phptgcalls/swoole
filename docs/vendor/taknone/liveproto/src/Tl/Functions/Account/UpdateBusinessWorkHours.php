<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param businessworkhours business_work_hours
 * @return Bool
 */

final class UpdateBusinessWorkHours extends Instance {
	public function request(? object $business_work_hours = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4b00e066);
		$flags = 0;
		$flags |= is_null($business_work_hours) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($business_work_hours) === false):
			$writer->write($business_work_hours->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>