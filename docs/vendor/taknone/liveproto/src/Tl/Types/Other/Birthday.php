<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int day int month int year
 * @return Birthday
 */

final class Birthday extends Instance {
	public function request(int $day,int $month,? int $year = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c8e1e06);
		$flags = 0;
		$flags |= is_null($year) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($day);
		$writer->writeInt($month);
		if(is_null($year) === false):
			$writer->writeInt($year);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['day'] = $reader->readInt();
		$result['month'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['year'] = $reader->readInt();
		else:
			$result['year'] = null;
		endif;
		return new self($result);
	}
}

?>