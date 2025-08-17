<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int total_daily int remains long stars_amount true query_is_free int wait_till
 * @return SearchPostsFlood
 */

final class SearchPostsFlood extends Instance {
	public function request(int $total_daily,int $remains,int $stars_amount,? true $query_is_free = null,? int $wait_till = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e0b5b6a);
		$flags = 0;
		$flags |= is_null($query_is_free) ? 0 : (1 << 0);
		$flags |= is_null($wait_till) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($total_daily);
		$writer->writeInt($remains);
		if(is_null($wait_till) === false):
			$writer->writeInt($wait_till);
		endif;
		$writer->writeLong($stars_amount);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['query_is_free'] = true;
		else:
			$result['query_is_free'] = false;
		endif;
		$result['total_daily'] = $reader->readInt();
		$result['remains'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['wait_till'] = $reader->readInt();
		else:
			$result['wait_till'] = null;
		endif;
		$result['stars_amount'] = $reader->readLong();
		return new self($result);
	}
}

?>