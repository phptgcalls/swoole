<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson json string zoom_token
 * @return StatsGraph
 */

final class StatsGraph extends Instance {
	public function request(object $json,? string $zoom_token = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ea464b6);
		$flags = 0;
		$flags |= is_null($zoom_token) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($json->read());
		if(is_null($zoom_token) === false):
			$writer->tgwriteBytes($zoom_token);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['json'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['zoom_token'] = $reader->tgreadBytes();
		else:
			$result['zoom_token'] = null;
		endif;
		return new self($result);
	}
}

?>