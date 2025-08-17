<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id true silent true unpin true pm_oneside
 * @return Updates
 */

final class UpdatePinnedMessage extends Instance {
	public function request(object $peer,int $id,? true $silent = null,? true $unpin = null,? true $pm_oneside = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd2aaf7ec);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 0);
		$flags |= is_null($unpin) ? 0 : (1 << 1);
		$flags |= is_null($pm_oneside) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>