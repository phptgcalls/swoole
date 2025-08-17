<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message true invert_media Vector<MessageEntity> entities replymarkup reply_markup
 * @return InputBotInlineMessage
 */

final class InputBotInlineMessageMediaAuto extends Instance {
	public function request(string $message,? true $invert_media = null,? array $entities = null,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3380c786);
		$flags = 0;
		$flags |= is_null($invert_media) ? 0 : (1 << 3);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['invert_media'] = true;
		else:
			$result['invert_media'] = false;
		endif;
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>