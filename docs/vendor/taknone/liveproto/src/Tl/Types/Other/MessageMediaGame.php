<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param game game
 * @return MessageMedia
 */

final class MessageMediaGame extends Instance {
	public function request(object $game) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfdb19008);
		$writer->write($game->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['game'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>