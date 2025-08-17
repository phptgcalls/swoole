<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot inputpeer peer string query string offset inputgeopoint geo_point
 * @return messages.BotResults
 */

final class GetInlineBotResults extends Instance {
	public function request(object $bot,object $peer,string $query,string $offset,? object $geo_point = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x514e999d);
		$flags = 0;
		$flags |= is_null($geo_point) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($bot->read());
		$writer->write($peer->read());
		if(is_null($geo_point) === false):
			$writer->write($geo_point->read());
		endif;
		$writer->tgwriteBytes($query);
		$writer->tgwriteBytes($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>