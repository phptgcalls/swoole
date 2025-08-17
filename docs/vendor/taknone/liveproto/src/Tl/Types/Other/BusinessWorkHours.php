<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string timezone_id Vector<BusinessWeeklyOpen> weekly_open true open_now
 * @return BusinessWorkHours
 */

final class BusinessWorkHours extends Instance {
	public function request(string $timezone_id,array $weekly_open,? true $open_now = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c92b098);
		$flags = 0;
		$flags |= is_null($open_now) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($timezone_id);
		$writer->tgwriteVector($weekly_open,'BusinessWeeklyOpen');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['open_now'] = true;
		else:
			$result['open_now'] = false;
		endif;
		$result['timezone_id'] = $reader->tgreadBytes();
		$result['weekly_open'] = $reader->tgreadVector('BusinessWeeklyOpen');
		return new self($result);
	}
}

?>