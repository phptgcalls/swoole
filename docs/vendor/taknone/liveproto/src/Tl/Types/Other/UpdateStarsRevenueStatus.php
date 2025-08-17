<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer starsrevenuestatus status
 * @return Update
 */

final class UpdateStarsRevenueStatus extends Instance {
	public function request(object $peer,object $status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa584b019);
		$writer->write($peer->read());
		$writer->write($status->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['status'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>