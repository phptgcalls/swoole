<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string type inputphoto photo inputbotinlinemessage send_message
 * @return InputBotInlineResult
 */

final class InputBotInlineResultPhoto extends Instance {
	public function request(string $id,string $type,object $photo,object $send_message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8d864a7);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($type);
		$writer->write($photo->read());
		$writer->write($send_message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['type'] = $reader->tgreadBytes();
		$result['photo'] = $reader->tgreadObject();
		$result['send_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>