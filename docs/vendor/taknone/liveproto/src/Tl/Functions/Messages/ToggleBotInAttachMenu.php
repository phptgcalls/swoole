<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot bool enabled true write_allowed
 * @return Bool
 */

final class ToggleBotInAttachMenu extends Instance {
	public function request(object $bot,bool $enabled,? true $write_allowed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x69f59d69);
		$flags = 0;
		$flags |= is_null($write_allowed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($bot->read());
		$writer->tgwriteBool($enabled);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>