<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts int date int qts int pts_limit int pts_total_limit int qts_limit
 * @return updates.Difference
 */

final class GetDifference extends Instance {
	public function request(int $pts,int $date,int $qts,? int $pts_limit = null,? int $pts_total_limit = null,? int $qts_limit = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x19c2f763);
		$flags = 0;
		$flags |= is_null($pts_limit) ? 0 : (1 << 1);
		$flags |= is_null($pts_total_limit) ? 0 : (1 << 0);
		$flags |= is_null($qts_limit) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($pts);
		if(is_null($pts_limit) === false):
			$writer->writeInt($pts_limit);
		endif;
		if(is_null($pts_total_limit) === false):
			$writer->writeInt($pts_total_limit);
		endif;
		$writer->writeInt($date);
		$writer->writeInt($qts);
		if(is_null($qts_limit) === false):
			$writer->writeInt($qts_limit);
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