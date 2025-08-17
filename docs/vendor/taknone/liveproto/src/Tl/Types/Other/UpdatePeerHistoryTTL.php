<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int ttl_period
 * @return Update
 */

final class UpdatePeerHistoryTTL extends Instance {
	public function request(object $peer,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbb9bb9a5);
		$flags = 0;
		$flags |= is_null($ttl_period) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		return new self($result);
	}
}

?>