<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id botmenubutton button
 * @return Bool
 */

final class SetBotMenuButton extends Instance {
	public function request(object $user_id,object $button) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4504d54f);
		$writer->write($user_id->read());
		$writer->write($button->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>