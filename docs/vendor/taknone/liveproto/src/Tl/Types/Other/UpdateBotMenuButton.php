<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id botmenubutton button
 * @return Update
 */

final class UpdateBotMenuButton extends Instance {
	public function request(int $bot_id,object $button) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x14b85813);
		$writer->writeLong($bot_id);
		$writer->write($button->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bot_id'] = $reader->readLong();
		$result['button'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>