<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift true keep_original_details
 * @return Updates
 */

final class UpgradeStarGift extends Instance {
	public function request(object $stargift,? true $keep_original_details = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaed6e4f5);
		$flags = 0;
		$flags |= is_null($keep_original_details) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($stargift->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>