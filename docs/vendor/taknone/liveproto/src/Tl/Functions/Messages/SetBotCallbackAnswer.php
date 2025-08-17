<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id int cache_time true alert string message string url
 * @return Bool
 */

final class SetBotCallbackAnswer extends Instance {
	public function request(int $query_id,int $cache_time,? true $alert = null,? string $message = null,? string $url = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd58f130a);
		$flags = 0;
		$flags |= is_null($alert) ? 0 : (1 << 1);
		$flags |= is_null($message) ? 0 : (1 << 0);
		$flags |= is_null($url) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		if(is_null($message) === false):
			$writer->tgwriteBytes($message);
		endif;
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		$writer->writeInt($cache_time);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>