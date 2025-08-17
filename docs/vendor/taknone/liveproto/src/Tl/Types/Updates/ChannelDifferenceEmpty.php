<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Updates;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int pts true final int timeout
 * @return updates.ChannelDifference
 */

final class ChannelDifferenceEmpty extends Instance {
	public function request(int $pts,? true $final = null,? int $timeout = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e11affb);
		$flags = 0;
		$flags |= is_null($final) ? 0 : (1 << 0);
		$flags |= is_null($timeout) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($pts);
		if(is_null($timeout) === false):
			$writer->writeInt($timeout);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['final'] = true;
		else:
			$result['final'] = false;
		endif;
		$result['pts'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['timeout'] = $reader->readInt();
		else:
			$result['timeout'] = null;
		endif;
		return new self($result);
	}
}

?>