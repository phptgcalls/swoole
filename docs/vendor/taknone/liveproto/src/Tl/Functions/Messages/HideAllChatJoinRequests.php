<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true approved string link
 * @return Updates
 */

final class HideAllChatJoinRequests extends Instance {
	public function request(object $peer,? true $approved = null,? string $link = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe085f4ea);
		$flags = 0;
		$flags |= is_null($approved) ? 0 : (1 << 0);
		$flags |= is_null($link) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($link) === false):
			$writer->tgwriteBytes($link);
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