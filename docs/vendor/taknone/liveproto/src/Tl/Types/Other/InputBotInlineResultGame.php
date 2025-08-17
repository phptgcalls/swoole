<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string short_name inputbotinlinemessage send_message
 * @return InputBotInlineResult
 */

final class InputBotInlineResultGame extends Instance {
	public function request(string $id,string $short_name,object $send_message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4fa417f2);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($short_name);
		$writer->write($send_message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['short_name'] = $reader->tgreadBytes();
		$result['send_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>