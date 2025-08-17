<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param replymarkup reply_markup
 * @return InputBotInlineMessage
 */

final class InputBotInlineMessageGame extends Instance {
	public function request(? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4b425864);
		$flags = 0;
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>