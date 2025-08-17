<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long giveaway_id inputstorepaymentpurpose purpose
 * @return Updates
 */

final class LaunchPrepaidGiveaway extends Instance {
	public function request(object $peer,int $giveaway_id,object $purpose) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5ff58f20);
		$writer->write($peer->read());
		$writer->writeLong($giveaway_id);
		$writer->write($purpose->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>